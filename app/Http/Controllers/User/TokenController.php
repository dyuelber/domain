<?php

namespace App\Http\Controllers\v1;

use App\Domains\Users\Services\UserService;
use App\Http\Controllers\AbstractController;
use App\Http\Requests\RequestToken;
use Illuminate\Http\Request;

class TokenController extends AbstractController
{
    public function __construct(UserService $service, RequestToken $request)
    {
        $this->service = $service;
        $this->request = $request;
    }

    public function updateAbilities(Request $request)
    {
        $id = $this->idParam($request);
        try {
            $response = $this->service->updateAbilities($request->all(), $id);
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
        }

        return $this->success($response);
    }
}
