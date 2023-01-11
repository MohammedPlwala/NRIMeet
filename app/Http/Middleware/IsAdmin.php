<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\User\Entities\Role;
use Modules\User\Entities\UserRole;

class IsAdmin
{
    public function handle($request, Closure $next)
    {
        if (\Auth::user()) {
            
            $userRole = UserRole::select('r.name as role')->leftJoin('roles as r','user_role.role_id','=','r.id')->where('user_id',\Auth::user()->id)->first();

            if($userRole->role == 'Guest'){
                \Auth::logout();
                return redirect('admin/login')->with('error', 'You are not allowed to access this portal.');
            }
            
            return $next($request);
        }


        return redirect('admin/login');
    }
}
