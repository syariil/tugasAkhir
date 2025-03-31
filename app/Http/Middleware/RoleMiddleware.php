<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$role): Response
    {
        $user = auth()->user();
        $route = $request->route()->getName();
        $registration = DB::table('systems')->select('registration')->first();
        $registration = $registration->registration ?? false;
        // dd($route);
        // mengecek apakah user telah login
        $id = $request->route('id');
        $routeName = ['tim.view', 'tim.edit', 'tim.update', 'schedule.admin.view'];

        if (!auth()->check()) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        // Periksa role user
        // dd($i);
        if (in_array($user->role, $role)) {
            switch ($user->role) {
                case "peserta":
                    $routeAllowed = in_array($route, $routeName);
                    if ($route === "dashboard" || ($routeAllowed && $user->tim_id === $id->id)) {
                        if (!$registration && $route === "tim.edit") {
                            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
                        }
                        return $next($request);
                    }
                    break;
                case "admin":
                    return $next($request);

                default:
                    abort(403, 'Anda tidak memiliki akses ke halaman ini.');
            }
        }

        // Jika tidak termasuk, tampilkan error 403
        abort(403, 'Anda tidak memiliki akses ke halaman ini.');
    }
}
