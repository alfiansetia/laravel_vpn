<?php

namespace App\Traits;

use App\Models\Router;

trait RouterTrait
{
    protected $router;
    protected $conn;

    private function setRouter(string $id, string $serviceClass)
    {
        $this->router = Router::where('user_id', auth()->user()->id)->find($id);
        $this->conn = new $serviceClass($this->router);
        return $this->conn;
    }
}
