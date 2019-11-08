<?php

namespace App\Http\Controllers;
use App\Proposition;
use App\Livrer;
use App\Devi;
use App\User;
use App\Impression;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request; 
use File;
use Storage;

class LivreurController extends Controller
{
    //
    public function compte(){      
    	$users = User::join('roles','roles.id','=','users.role_id')->where('users.id','=',Auth::id())->get();
    	return view('livreurs.compte', compact('users'));
    }

    public function compteV(){
    	$users = User::join('roles','roles.id','=','users.role_id')->where('users.id','=',Auth::id())->get();
    	return view('livreurs.compteV', compact('users'));
    }

    public function livrer(){
    	$propositions = Proposition::join('users','users.id','=','propositions.id_user')->get();
    	$livreurs = Livrer::join('impressions','impressions.id_impression','=','livrer.id_impression')->join('propositions','propositions.id_proposition','=','impressions.id_proposition')->join('devis','devis.id_devi','=','propositions.id_devi')->get();
    	$impressions = Impression::join('propositions','propositions.id_proposition','=','impressions.id_proposition')->join('devis','devis.id_devi','=','propositions.id_devi')->join('users','users.id','=','impressions.id_user')->where('impressions.valider_impression','=',1)->get();
    	return view('livreurs.livraison', compact('propositions','impressions','livreurs'));
    }

    public function editImpressionL(Request $request){
    	if($request->ajax()){
            return response(Impression::find($request->id_impression));
        }
    }

    public function postInsertLivrer(Request $request){
        response(Livrer::create(['libelle_livrer'=>$request->libelle_livrer,'date_livrer'=>date("Y-m-d H:i:s"),'id_impression'=>$request->id_impression,'valider_livrer'=>$request->valider_livrer,'id_user'=>Auth::id()]));
        return back();
    }
}
