<?php

namespace App\Http\Middleware;

use App\Models\UserRole;
use Closure;
use Illuminate\Http\Request;

class CheckRolePlatform
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
        if (!in_array($request->user()->ref_user_role_id, [UserRole::ADMIN, UserRole::CONFRERE, UserRole::SU_ADMIN])) {
            return redirect()->route('office.dashboard')->with('error', 'Vous n\'avez pas accès à cette section.');
        }
    
        return $next($request);
    }
}
