<?php

namespace App\Http\Controllers;

use App\Domains\Abstracts\Services\AbstractService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Throwable;

abstract class AbstractController extends Controller
{
    protected AbstractService $service;
    protected $requestCreate;
    protected $requestUpdate;

    protected function index(Request $request)
    {
        try {
            $response = $this->service->all();
        } catch (Throwable $th) {
            return $this->error($th->getMessage());
        }

        return $this->success($response);
    }

    protected function store(Request $request)
    {
        try {
            if ($this->requestCreate) {
                app($this->requestCreate);
            }

            $response = $this->service->create($request->all());
        } catch (Throwable | ValidationException $th) {
            if ($th instanceof ValidationException) {
                return $this->error(null, $th->errors());
            }

            return $this->error($th->getMessage());
        }

        return $this->success($response, null, Response::HTTP_CREATED);
    }

    protected function show(Request $request, $id)
    {
        try {
            $response = $this->service->find($id);
        } catch (Throwable $th) {
            return $this->error($th->getMessage());
        }

        return $this->success($response);
    }

    protected function update(Request $request, $id)
    {
        try {
            if ($this->requestUpdate) {
                app($this->requestUpdate);
            }

            $response = $this->service->update($id, $request->all());
        } catch (Throwable | ValidationException $th) {
            if ($th instanceof ValidationException) {
                return $this->error(null, $th->errors());
            }

            return $this->error($th->getMessage());
        }

        return $this->success($response);
    }

    protected function destroy($id)
    {
        try {
            $response = $this->service->delete($id);
        } catch (Throwable $th) {
            return $this->error($th->getMessage());
        }

        return $this->success($response);
    }

    protected function success(mixed $data, string $msg = null, int $status = Response::HTTP_OK)
    {
        return response()->json([
            'type'     => 'success',
            'status'   => $status,
            'message'  => $msg ?? 'Successful operation',
            'response' => $data,
        ], $status);
    }

    protected function error(string $msg = null, mixed $data = null, int $status = Response::HTTP_UNPROCESSABLE_ENTITY)
    {
        return response()->json([
            'type'     => 'error',
            'status'   => $status,
            'message'  => $msg ?? 'Operation failure',
            'response' => $data,
        ], $status);
    }
}
