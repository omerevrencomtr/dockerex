<?php

namespace App\Http\Middleware;

use Closure;

/**
 * Class PreferredDomain
 * @package App\Http\Middleware
 */
class WwwProtocol
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $host=$request->header('host');
        if (substr($host, 0, 4) != 'www.') {
            $request->headers->set('host', 'www.'.$host);
            return redirect()->to($request->path());
        }
        return $next($request);
    }
}
