<?php

namespace App\Services\Mikapi\PPP;

use App\Models\Router;
use App\Services\RouterApiServices;
use App\Traits\CrudApiTrait;

class SecretServices extends RouterApiServices
{
    use CrudApiTrait;

    public function __construct(Router $router)
    {
        parent::__construct($router);
        $this->name = 'ppp';
        $this->command = '/ppp/secret/';
    }
}
