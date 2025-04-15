<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        /* foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                switch (Auth::guard($guard)->user()->role) {
                    case User::ROL_ADMINISTRADOR | User::ROL_EMPLEADO:
                        return redirect()->route('dashboard.index');
                        break;
                    case User::ROL_CLIENTE:
                        return redirect(RouteServiceProvider::FOR_CLIENTS);
                        break;
                }
            }
        } */
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }

    /*
    public function authenticated($request, $user)
	{
		if ($user->hasRole(User::ROL_ADMINISTRADOR)) {
			return redirect()->route('dashboard.index');
		} elseif ($user->hasRole(User::ROL_CLIENTE)) {
			return redirect()->route('gestor-archivos.page');
		}
	}
    */

    /*
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
               switch (Auth::guard($guard)->user()->role){
                   // Redirect Admin Dashboard
                  case 'Admin':
                    return redirect('/AdminDashboard');
                    break;

                  // If need any Roles for example:
                  case: 'RoleName':
                  return redirect('url');
                  break;
                  default: return  redirect('/GeneralDashboard');
               }
            }
        }
        return $next($request);
    }
     */
}
