<?php

namespace App\Services;

use App\Models\Server;
use App\Models\Vpn;
use App\RouterOs\RouterosAPI;
use Exception;

class ServerApiServices
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

    public function store(array $data, array $dst)
    {
        if ($this->connect()) {
            $this->API->comm("/ppp/secret/add", array(
                'service'           => 'any',
                'name'              => $data['username'],
                'password'          => $data['password'],
                'local-address'     => $this->server->netwatch,
                'remote-address'    => $data['ip'],
                'disabled'          => $data['is_active'] === 'yes' ? 'no' : 'yes',
                'comment'           => strtolower(date('M/d/Y', strtotime($data['expired']))),
            ));
            $to = [80, 8728, 8291];
            for ($i = 0; $i < count($dst); $i++) {
                $this->API->comm('/ip/firewall/nat/add', array(
                    'chain'         => 'dstnat',
                    'action'        => 'dst-nat',
                    'to-addresses'  => $data['ip'],
                    'to-ports'      => $to[$i],
                    'protocol'      => 'tcp',
                    'dst-port'      => $dst[$i],
                    'disabled'      => 'no',
                    'comment'       => $data['username'],
                ));
            }
            $this->disconnect();
        } else {
            throw new Exception('Selected Server Error!', 500);
        }
    }

    public function update(Vpn $vpn, array $data)
    {
        if ($this->connect()) {
            $ports = $vpn->port;
            $ppp = $this->API->comm("/ppp/secret/print", array(
                "?name" => $vpn->username,
            ));
            $active = $this->API->comm("/ppp/active/print", array(
                "?name" => $vpn->username,
            ));
            foreach ($ppp as $value) {
                $this->API->comm("/ppp/secret/remove", array(
                    ".id" => $value['.id'],
                ));
            }
            $nat = $this->API->comm("/ip/firewall/nat/print", array(
                "?comment"  => $vpn->username,
            ));
            foreach ($nat as $value) {
                $this->API->comm("/ip/firewall/nat/remove", array(
                    ".id" => $value['.id'],
                ));
            }
            $this->API->comm("/ppp/secret/add", array(
                "service"           => "any",
                "name"              => $data['username'],
                "password"          => $data['password'],
                "local-address"     => $vpn->server->netwatch,
                "remote-address"    => $data['ip'],
                "disabled"          => $data['is_active'] === 'yes' ? 'no' : 'yes',
                "comment"           => strtolower(date('M/d/Y', strtotime($data['expired']))),
            ));

            foreach ($ports as $value) {
                $this->API->comm("/ip/firewall/nat/add", array(
                    "chain"         => "dstnat",
                    "action"        => "dst-nat",
                    "protocol"      => "tcp",
                    "disabled"      => "no",
                    "to-addresses"  => $data['ip'],
                    "to-ports"      => $value->to,
                    "dst-port"      => $value->dst,
                    "comment"       => $data['username'],
                ));
            }

            foreach ($active as $value) {
                $this->API->comm("/ppp/active/remove", array(
                    ".id" => $value['.id'],
                ));
            }
            $this->disconnect();
            return true;
        } else {
            throw new Exception('Selected Server Error!', 500);
        }
    }


    public function destroy(Vpn $vpn)
    {
        if ($this->connect()) {
            $user = $this->API->comm("/ppp/secret/print", array(
                "?name"  => $vpn->username,
            ));
            $active = $this->API->comm("/ppp/active/print", array(
                "?name"  => $vpn->username,
            ));
            $ports = $this->API->comm("/ip/firewall/nat/print", array(
                "?comment"  => $vpn->username,
            ));
            foreach ($user as $value) {
                $this->API->comm("/ppp/secret/remove", array(
                    ".id"  => $value['.id'],
                ));
            }
            foreach ($active as $value) {
                $this->API->comm("/ppp/active/remove", array(
                    ".id"  => $value['.id'],
                ));
            }
            foreach ($ports as $value) {
                $this->API->comm("/ip/firewall/nat/remove", array(
                    '.id'   => $value['.id'],
                ));
            }
            $this->disconnect();
            return true;
        } else {
            throw new Exception('Selected Server Error!', 500);
        }
    }

    public function analyze(Vpn $vpn)
    {
        if ($this->connect()) {
            $user = $this->API->comm("/ppp/secret/print", array(
                "?name"  => $vpn->username,
            ));
            if (empty($user)) {
                throw_not_found();
            }
            return $user;
        } else {
            throw new Exception('Selected Server Error!', 500);
        }
    }
}
