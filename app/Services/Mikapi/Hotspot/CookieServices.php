<?php

namespace App\Services\Mikapi\Hotspot;

use App\Models\Router;
use App\Services\RouterApiServices;
use App\Traits\CrudApiTrait;

class CookieServices extends RouterApiServices
{
    use CrudApiTrait;

    public function __construct(Router $router)
    {
        parent::__construct($router);
        $this->name = 'hotspot';
        $this->command = '/ip/hotspot/cookie/';
    }
}
