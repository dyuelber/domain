<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\AbstractController;
use App\Http\Requests\RequestToken;
use App\Repositories\UserRepository;
use App\Services\UserService;
use Illuminate\Http\Request;

class TokenController extends AbstractController
{
    public function __construct()
    {
        $this->repository = new UserRepository();
        $this->service    = new UserService();
        $this->request    = new RequestToken();
    }

    public function index(Request $request)
    {
        return $this->success($this->repository->abilities());
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
