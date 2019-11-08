<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

use Illuminate\Contracts\Auth\Guard;

class RedirectIfAuthenticated
{

    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        /*if (Auth::guard($guard)->check()) {
            return redirect('/home');
        }*/

        if (Auth::guard($guard)->check()) {

            //return redirect('/welcome');

            $auth = Auth::user()->role()->first();

            switch ($auth->name) {
                case 'Admin':
                        return  redirect('/admin');    
                    break;
                case 'Client':
                        return  redirect('/client'); 
                    break;
                case 'Design':
                        return  redirect('/design');  
                    break;

                case 'Imprimeur':
                        return  redirect('/imprimeur');  
                    break;

                case 'Livreur':
                        return  redirect('/livreur');  
                    break;

            }   

         }

        return $next($request);
    }
}
