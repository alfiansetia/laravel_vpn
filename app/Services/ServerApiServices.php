<?php

namespace App\Services;

use App\Models\Server;
use App\RouterOs\RouterosAPI;

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
        $ip = $this->server->ip . ':' . $this->server->port;
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
            return handle_data([], 'Connected');
        } else {
            return handle_fail_login($this->API);
        }
    }
}
