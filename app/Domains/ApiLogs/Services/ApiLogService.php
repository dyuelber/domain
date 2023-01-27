<?php

namespace App\Domains\ApiLogs\Services;

use App\Domains\Abstracts\Services\AbstractService;
use App\Domains\ApiLogs\Repositories\ApiLogRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

class ApiLogService extends AbstractService
{
    public function __construct(ApiLogRepository $repository)
    {
        $this->repository = $repository;
    }

    public function createLog(Request $request, Response|RedirectResponse|JsonResponse $response)
    {
        try {
            $currentRouteAction = Route::currentRouteAction();

            $controller = explode('@', $currentRouteAction)[0];
            $action     = explode('@', $currentRouteAction)[1];

            $payload = [
                'request'  => $request->all(),
                'response' => $response->original,
            ];

            $data = [
                'user_id'    => auth()->user()->id ?? null,
                'ip'         => $request->ip(),
                'method'     => $request->method(),
                'url'        => $request->path(),
                'code'       => $response->status(),
                'duration'   => number_format(microtime(true) - LARAVEL_START, 3),
                'controller' => $controller,
                'action'     => $action,
                'payload'    => json_encode($payload),
            ];

            return $this->repository->create($data);
        } catch (\Throwable $th) {
            Log::alert($th->getMessage(), $request->all());
        }
    }
}
