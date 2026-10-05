<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdminAuthenticated
{
    public function handle(Request $request, Closure $next): Response
    {
        // Session Store does not provide the Request input's `boolean()` helper.
        if (! (bool) $request->session()->get('admin_authenticated', false)) {
            return redirect()->route('admin.login');
        }

        return $next($request);
    }
}
