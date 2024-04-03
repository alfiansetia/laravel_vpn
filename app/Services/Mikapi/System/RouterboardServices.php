<?php

namespace App\Services\Mikapi\System;

use App\Models\Router;
use App\Services\RouterApiServices;
use App\Traits\CrudApiTrait;

class RouterboardServices extends RouterApiServices
{
    use CrudApiTrait;

    public function __construct(Router $router)
    {
        parent::__construct($router);
        $this->name = 'system';
        $this->command = '/system/routerboard/';
    }

    public function routerboard()
    {
        if ($this->connect()) {
            $data = $this->API->comm('/system/routerboard/print');
            cek_error($data);
            $this->disconnect();
            return $data;
        } else {
            return handle_fail_login($this->API);
        }
    }

    public function setting()
    {
        if ($this->connect()) {
            $data = $this->API->comm('/system/routerboard/settings/print');
            cek_error($data);
            $this->disconnect();
            return $data;
        } else {
            return handle_fail_login($this->API);
        }
    }
}
