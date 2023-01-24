<?php

namespace App\Http\Controllers\v1;

use App\Domain\Users\Services\UserService;
use App\Http\Controllers\AbstractController;
use App\Http\Requests\RequestCreateUser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends AbstractController
{
    public function __construct(
        UserService $userService,
        RequestCreateUser $requestCreateUser
    ) {
        $this->service = $userService;
        $this->request = $requestCreateUser;
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
