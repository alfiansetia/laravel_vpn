<?php

namespace App\Services\Mikapi;

use App\Models\Router;
use App\Services\RouterApiServices;
use App\Traits\CrudApiTrait;

class InterfaceServices extends RouterApiServices
{
    use CrudApiTrait;

    public function __construct(Router $router)
    {
        parent::__construct($router);
        $this->name = 'system';
        $this->command = '/interface/';
    }

    public function monitor($id)
    {
        if ($this->connect()) {
            $data = $this->API->comm("/interface/monitor-traffic", [
                'interface' => $id,
                'once'      => '',
            ]);
            cek_error($data);
            $this->disconnect();
            return $data;
        } else {
            return handle_fail_login($this->API);
        }
    }
}
