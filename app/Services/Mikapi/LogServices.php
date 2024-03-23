<?php

namespace App\Services\Mikapi;

use App\Models\Router;
use App\Services\RouterApiServices;
use App\Traits\CrudApiTrait;

class LogServices extends RouterApiServices
{
    use CrudApiTrait;

    public function __construct(Router $router)
    {
        parent::__construct($router);
        $this->name = 'system';
        $this->command = '/log/';
    }

    public function destroy()
    {
        if ($this->connect()) {
            $data1 = $this->API->comm('/system/logging/action/set', [
                'numbers'       => 0,
                'memory-lines'  => 1
            ]);
            cek_error($data1);
            $data2 = $this->API->comm('/system/logging/action/set', [
                'numbers'       => 0,
                'memory-lines'  => 1000
            ]);
            cek_error($data2);
            $this->disconnect();
            return $data1;
        } else {
            return handle_fail_login($this->API);
        }
    }
}
