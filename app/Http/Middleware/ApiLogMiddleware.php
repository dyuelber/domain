<?php

namespace App\Http\Middleware;

use App\Services\ApiLogService;
use Closure;
use Illuminate\Http\Request;

class ApiLogMiddleware
{
    protected $service;

    public function __construct(ApiLogService $service)
    {
        $this->service = $service;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        return $next($request);
    }

    public function terminate($request, $response): void
    {
        $this->service->createLog($request, $response);
    }
}
