<?php

namespace App\Http\Middleware;

use App\Repositories\DomainRepository;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class DomainMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $subDomain = explode('.', $request->host())[0];
        $domainBase = explode('.', config('app.domain'))[0];

        if (! Cache::get($subDomain) && $subDomain != $domainBase) {
            $domain = (new DomainRepository())->findByKey('current', $subDomain);
            
            if (! $domain) {
                return redirect()->away(config('app.url'));
            }

            Cache::put($domain->current, $domain->current);
        }

        return $next($request);
    }
}
