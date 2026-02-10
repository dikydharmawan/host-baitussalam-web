<?php

namespace App\Http\Middleware;

use Closure;
use App\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureTakmir
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect('/')
                ->with('error', 'Silakan login sebagai takmir terlebih dahulu.');
        }

        $allowedRoles = [
            UserRole::SUPER_ADMIN,
            UserRole::TAKMIR_ADMIN,
            UserRole::TAKMIR,
        ];

        if (!in_array(Auth::user()->role, $allowedRoles, true)) {
            abort(403, 'Anda tidak memiliki akses.');
        }

        return $next($request);
    }
}
