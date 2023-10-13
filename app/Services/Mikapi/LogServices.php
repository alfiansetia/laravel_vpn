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
}
