<?php

namespace App\Services;

use App\Repositories\ApiLogRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

class ApiLogService extends AbstractService
{
    public function __construct()
    {
        $this->repository = new ApiLogRepository();
    }

    public function createLog(Request $request, Response|RedirectResponse $response)
    {
        $endTime = microtime(true);

        $currentRouteAction = Route::currentRouteAction();

        $data = [
            'user_id' => auth()->user() ?? null,
            'ip' => $request->ip(),
            'method' => $request->method(),
            'url' => $request->path(),
            'code' => $response->status(),
            'duration' => number_format($endTime - LARAVEL_START, 3),
            'controller' => $currentRouteAction,
            'action' => $currentRouteAction,
            'payload' => json_encode($request->all()),
        ];

        return $this->repository->create($data);
    }
}
