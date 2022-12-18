<?php

namespace App\Http\Controllers;

use App\Http\Requests\AbstractRequest;
use App\Repositories\AbstractRepository;
use App\Services\AbstractService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

abstract class AbstractController extends Controller
{
    public function __construct(
        protected AbstractService $service,
        protected AbstractRepository $repository,
        protected AbstractRequest $request
    ) {
        $this->service = $service;
        $this->repository = $repository;
        $this->request = $request;
    }

    public function idParam(Request $request): string
    {
        return '';
    }

    protected function index(Request $request)
    {
        try {
            $response = $this->repository->all();
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
        }

        return $this->success($response);
    }

    protected function store(Request $request)
    {
        try {
            $this->validate($request, $this->request->rules());
            $response = $this->service->create($request->all());
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
        }

        return $this->success($response, null, Response::HTTP_CREATED);
    }

    protected function show(Request $request)
    {
        $id = $this->idParam($request);
        try {
            $response = $this->repository->find($id);
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
        }

        return $this->success($response);
    }

    protected function update(Request $request)
    {
        $id = $this->idParam($request);
        try {
            $this->validate($request, $this->request->rules());
            $response = $this->service->update($request->all(), $id);
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
        }

        return $this->success($response);
    }

    protected function destroy(Request $request)
    {
        $id = $this->idParam($request);

        try {
            $response = $this->service->delete($id);
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
        }

        return $this->success($response);
    }

    protected function success(mixed $data, string $msg = null, int $status = Response::HTTP_OK)
    {
        return response()->json([
            'type' => 'success',
            'status' => $status,
            'message' => $msg ?? 'Successful operation',
            'response' => $data
        ], $status);
    }

    protected function error(string $msg = null, mixed $data = null, int $status = Response::HTTP_UNPROCESSABLE_ENTITY)
    {
        return response()->json([
            'type' => 'error',
            'status' => $status,
            'message' => $msg ?? 'Operation failure',
            'response' => $data
        ], $status);
    }
}
