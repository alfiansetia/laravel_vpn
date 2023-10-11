<?php

namespace App\Traits;

use App\Models\Router;

trait RouterTrait
{

    private $router;
    private $conn;

    private function setRouter(string $id, string $serviceClass)
    {
        $this->router = Router::where('user_id', auth()->user()->id)->find($id);
        $this->conn = new $serviceClass($this->router);
    }
}
