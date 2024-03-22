<?php

namespace App\Services;

use App\Models\Port;
use App\Models\Server;
use App\Models\Vpn;
use App\RouterOs\RouterosAPI;
use Exception;

class PortApiServices
{
    protected $server;
    protected $API;

    public function __construct(Server $server)
    {
        $this->server = $server;
        $this->API = new RouterosAPI();
        $this->API->debug = false;
        $this->API->timeout = 2;
        $this->API->attempts = 1;
    }

    protected function connect()
    {
        $ip = ($this->server->ip . ($this->server->port != 0 ? (':' . $this->server->port) : ''));
        $user = $this->server->username;
        try {
            $pass = decrypt($this->server->password);
        } catch (\Throwable $th) {
            $pass = '';
        }
        return $this->API->connect($ip, $user, $pass);
    }

    protected function disconnect()
    {
        return $this->API->disconnect();
    }

    public function ping()
    {
        if ($this->connect()) {
            return true;
        } else {
            $message  = '';
            if ($this->API->error_str == "") {
                $message = $this->API->error_str = "User/Password Wrong!";
            }
            $message = 'Router Not Connect!  ' . $this->API->error_str;
            throw new Exception($message, 500);
        }
    }

    public function store(array $data)
    {
        if ($this->connect()) {
            $exist = $this->API->comm("/ip/firewall/nat/print", array(
                "?comment"      => $data['username'],
                "?to-addresses" => $data['ip'],
                "?dst-port"     => $data['dst'],
                "?to-ports"     => $data['to'],
                '?disabled'     => 'no',
            ));
            cek_error($exist);
            cek_exists($exist);
            $new = $this->API->comm('/ip/firewall/nat/add', array(
                'chain'         => 'dstnat',
                'action'        => 'dst-nat',
                'to-addresses'  => $data['ip'],
                'to-ports'      => $data['to'],
                'protocol'      => 'tcp',
                'dst-port'      => $data['dst'],
                'disabled'      => 'no',
                'comment'       => $data['username'],
            ));
            cek_error($new);
            $this->disconnect();
            return $new;
        } else {
            throw new Exception('Selected Server Error!', 500);
        }
    }

    public function update(Port $port, array $data)
    {
        if ($this->connect()) {
            $username = $port->vpn->username;
            $ip = $port->vpn->ip;
            $ppp = $this->API->comm("/ip/firewall/nat/print", array(
                "?comment"      => $username,
                "?to-addresses" => $ip,
                "?dst-port"     => $port->dst,
                "?to-ports"     => $port->to,
                '?disabled'     => 'no',
            ));
            cek_error($ppp);
            if (empty($ppp)) {
                $param = [
                    'ip'        => $ip,
                    'username'  => $username,
                    'dst'       => $data['dst'],
                    'to'        => $data['to'],
                ];
                $this->store($param);
            }
            foreach ($ppp as $item) {
                $this->API->comm('/ip/firewall/nat/set', [
                    '.id'       => $item['.id'],
                    'dst-port'  => $data['dst'],
                    'to-ports'  => $data['to'],
                    'disabled'  => 'no',
                ]);
            }
            if (count($ppp) > 1) {
                for ($i = 0; $i < (count($ppp) - 1); $i++) {
                    $this->API->comm('/ip/firewall/nat/remove', [
                        '.id'       => $ppp[$i]['.id'],
                    ]);
                }
            }
            $this->disconnect();
            return true;
        } else {
            throw new Exception('Selected Server Error!', 500);
        }
    }


    public function destroy(Port $port)
    {
        if ($this->connect()) {
            $ports = $this->API->comm("/ip/firewall/nat/print", array(
                "?comment"      => $port->vpn->username,
                "?to-addresses" => $port->vpn->ip,
                "?dst-port"     => $port->dst,
                "?to-ports"     => $port->to,
                '?disabled'     => 'no',
            ));
            cek_error($ports);
            foreach ($ports as $value) {
                $this->API->comm("/ip/firewall/nat/remove", [
                    ".id"  => $value['.id'],
                ]);
            }
            $this->disconnect();
            return [];
        } else {
            throw new Exception('Selected Server Error!', 500);
        }
    }
}
