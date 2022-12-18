<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;

    public function success(mixed $data, string $msg = null, int $status = Response::HTTP_OK)
    {
        return response()->json([
            'type' => 'success',
            'message' => $msg,
            'data' => $data
        ], $status);
    }

    public function error(string $msg = null, mixed $data = null, int $status = Response::HTTP_UNPROCESSABLE_ENTITY)
    {
        return response()->json([
            'type' => 'error',
            'message' => $msg,
            'data' => $data
        ], $status);
    }
}
