<?php

namespace App\Services\Mikapi\DHCP;

use App\Models\Router;
use App\Services\RouterApiServices;
use App\Traits\CrudApiTrait;

class LeaseServices extends RouterApiServices
{
    use CrudApiTrait;

    public function __construct(Router $router)
    {
        parent::__construct($router);
        $this->name = 'dhcp';
        $this->command = '/ip/dhcp-server/lease/';
    }
}
