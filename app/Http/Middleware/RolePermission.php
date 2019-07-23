<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Core\Check;

class RolePermission
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
        // check whether user is logged in
        $user = Auth::user();
        if ($user) {
            $permissions = session('permissions');

            $currentAction = $request->route()->getName(); // get route name
            $request_method = $request->method(); // get request method

            if (Check::hasPermission($permissions, $currentAction, $request_method)) {
                /* if user's role has permission for current request, proceed to request */
                return $next($request);
            } else {
                /* if user's role does not have permission for current request, abort and return exception */
                abort(403, 'Unauthorized action.');
            }
        } else {
            /* if user is not logged in, abort and return exception */
            abort(403, 'Unauthorized action.');
        }
        return $next($request);
    }
}
