<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\AbstractController;
use App\Http\Requests\RequestCreateUser;
use App\Repositories\UserRepository;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends AbstractController
{
    public function __construct()
    {
        $this->service = new UserService();
        $this->repository = new UserRepository();
        $this->request = new RequestCreateUser();
    }

    public function createUser(Request $request)
    {
        try {
            $this->validate($request, $this->request->rules());
            $response = $this->service->createUser($request->all());
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
        }

        return $this->success($response, null, Response::HTTP_CREATED);
    }
}
