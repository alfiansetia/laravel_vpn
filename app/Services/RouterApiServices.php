<?php

namespace App\Services;

use App\Models\Router;
use App\RouterOs\RouterosAPI;

class RouterApiServices
{
    protected $router;
    protected $API;

    public function __construct(Router $router)
    {
        $this->router = $router;
        $this->API = new RouterosAPI();
        $this->API->debug = false;
        $this->API->timeout = 2;
        $this->API->attempts = 1;
    }

    protected function connect()
    {
        $ip = $this->router->port->vpn->server->ip . ':' . $this->router->port->dst;
        $user = $this->router->username;
        try {
            $pass = decrypt($this->router->password);
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
            return handle_fail_login($this->API);
        }
    }
}
