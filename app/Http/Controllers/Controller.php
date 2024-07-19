<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function send_response(string $message = '', mixed $data = [], int $code = 200)
    {
        return response()->json([
            'message'   => $message,
            'data'      => $data,
        ], $code);
    }

    public function send_response_not_found(string $message = 'Data Not Found!')
    {
        return response()->json([
            'message'   => $message,
            'data'      => null,
        ], 404);
    }

    public function send_response_unauthorize(string $message = 'Unauthorize!')
    {
        return response()->json([
            'message'   => $message,
            'data'      => null,
        ], 403);
    }

    public function send_response_unauthenticate(string $message = 'Unauthenticate, Please Login!')
    {
        return response()->json([
            'message'   => $message,
            'data'      => null,
        ], 401);
    }
    public function send_error(string $message = 'Server Error!')
    {
        return response()->json([
            'message'   => $message,
            'data'      => null,
        ], 500);
    }
}
