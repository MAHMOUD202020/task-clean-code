<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HavRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next , $role)
    {
        return $next($request);

        $auth = \auth('admin')->user();

        if ($auth && ($auth_role = $auth->role )) {

            $permissions = ($permissions = $auth_role->permissions ) ? $permissions->map->name->all() : [];

            if (in_array($role, $permissions)) {

                return $next($request);

            } else {

                return abort(401, 'ليس لديك الصلاحية لدخول هاذا القسم');
            }

        }

        return  abort(404);
    }
}
