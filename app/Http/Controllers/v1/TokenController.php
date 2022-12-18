<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestToken;
use App\Services\CreateUserApi;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TokenController extends Controller
{
    public function index()
    {
        return $this->success(config('sanctum.abilities'));
    }

    public function store(RequestToken $request)
    {
        try {
            $token = (new CreateUserApi())->handle($request->all());
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
        }

        return $this->success($token, null, Response::HTTP_CREATED);
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
