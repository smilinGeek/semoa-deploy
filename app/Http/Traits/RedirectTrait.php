<?php

namespace App\Http\Traits;   // Or the place where the trait is stored (step 2)

use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\RegistersUsers;

trait RedirectTrait
{
 /**
 * Where to redirect users after register/login/reset based in roles.
 *
 * @param \Iluminate\Http\Request  $request
 * @param mixed $user
 * @return mixed
 */
public function RedirectBasedInRole(Request $request, $user) {

  //$route = '';

  //$user = Auth::user()->role()->first();

  switch ($user->name) {
    # Admin
        case 'Admin':
          return redirect()->intended('admin');
          //$route = 'admin';  // the admin's route
        break;

        # Client
        case 'Client':
        return redirect()->intended('client');
          //$route = 'client'; // the client's route
        break;

        # Imprimeur
        case 'Imprimeur':
        return redirect()->intended('imprimeur');
           //$route = 'imprimeur';   // the imprimeur's route
          break;

        # Livreur
        case 'Livreur':
        return redirect()->intended('livreur');
           //$route = 'livreur';   // the livreur's route
          break;  

        # Design
        case 'Design':
        return redirect()->intended('design');
          // $route = 'design';   // the design's route
          break;  
    }

    return redirect()->intended($route);
  }

}