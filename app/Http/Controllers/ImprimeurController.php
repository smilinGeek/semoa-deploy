<?php

namespace App\Http\Controllers;
use App\Proposition;
use App\Devi;
use App\User;
use App\Impression;
use Illuminate\Support\Facades\Response;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request; 
use File;
use Storage; 

class ImprimeurController extends Controller
{
    //

    public function getImage($image){
        //return "<img src='storage/ok'/>";
        $path = public_path().'/storage/'.$image;
        return Response::download($path);
    }

    public function compte(){     
    	$users = User::join('roles','roles.id','=','users.role_id')->where('users.id','=',Auth::id())->get();
    	return view('imprimeurs.compte', compact('users'));
    }

    public function compteV(){
    	$users = User::join('roles','roles.id','=','users.role_id')->where('users.id','=',Auth::id())->get();
    	return view('imprimeurs.compteV', compact('users'));
    }
 
    public function impression(){
    	$propositions = Proposition::join('users','users.id','=','propositions.id_user')->get();
    	$impressions = Impression::join('propositions','propositions.id_proposition','=','impressions.id_proposition')->join('devis','devis.id_devi','=','propositions.id_devi')->where('impressions.valider_impression','=',1)->get();
    	return view('imprimeurs.impression', compact('propositions','impressions'));
    }

    public function editPropositionI(Request $request){
    	if($request->ajax()){
            return response(Proposition::find($request->id_proposition));
        }
    }

    public function postInsertImpression(Request $request){
        response(Impression::create(['libelle_impression'=>$request->libelle_impression,'date_impression'=>date("Y-m-d H:i:s"),'id_proposition'=>$request->id_proposition,'valider_impression'=>$request->valider_impression,'id_user'=>Auth::id()]));
        return back();
    }


}
