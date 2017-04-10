<?php

namespace App\Http\Middleware;

use Closure;

use Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $roles_id)
    {
        if(Auth::check()){ // check if the user is logged in

            $roles_id = explode('|', $roles_id);                // Explode roles based on parameter given on route

            foreach($roles_id as $role_id){                     // Loop each roles based on parameter given on route
                if(Auth::user()->getRolesId() == $role_id){     // If auth user roles id same as role give in parameter return next request
                    return $next($request);
                }
            }

            // If no roles matches 

            if(Auth::user()->getRolesId() == 2){                // If roles id == 2, redirect to /dekan            
              return redirect('/dekan');
            }

            if(Auth::user()->getRolesId() == 3){                // If roles id == 2, redirect to /ketuajabatan            
              return redirect('/ketuajabatan');
            }

            if(Auth::user()->getRolesId() == 2){                // If roles id == 2, redirect to /pensyarah            
              return redirect('/pensyarah');
            }
        }

        return redirect('/login');                              // If user is not auth or logged in, go to /login
    }
}
