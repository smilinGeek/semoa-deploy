<?php

namespace App\Http\Controllers;
use App\Proposition;
use App\Devi;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use File;
use Storage;

class DesignController extends Controller
{
    //

    //uploader la premiere image
    public function Upload1(Request $request, $nom = 'image1_proposition'){
        if($request->hasFile($nom)){
            $request->file($nom);
            $photo = $request->image1_proposition;
            $extension = $photo->extension();
            $name = rand(11111, 99999).".".date('Y-m-d').".".time().".".$extension;
            Storage::disk('public')->put($name, File::get($request->image1_proposition));
            return $name;
        }else{
            return ' ';
        }
        
    }


    //uploader la deuxieme image
    public function Upload2(Request $request, $nom = 'image2_proposition'){
        if($request->hasFile($nom)){
            $request->file($nom);
            $photo = $request->image2_proposition;
            $extension = $photo->extension();
            $name = rand(11111, 99999).".".date('Y-m-d').".".time().".".$extension;
            Storage::disk('public')->put($name, File::get($request->image2_proposition));
            return $name;
        }else{
            return ' ';
        }
        
    }

    // editer une proposition
    public function editDeviD(Request $request){
        if($request->ajax()){
            return response(Devi::find($request->id_devi));
        }
    }

    //insertion d'une proposition
    public function postInsertProposition(Request $request){
       $temp1 = $this->Upload1($request);
       $temp2 = $this->Upload2($request);
        response(Proposition::create(['libelle_proposition'=>$request->libelle_proposition,'date_proposition'=>date("Y-m-d H:i:s"),'image1_proposition'=>$temp1,'image2_proposition'=>$temp2,'id_user'=>Auth::id(),'id_devi'=>$request->id_devi]));
        return back();
        
    }


    public function compte(){   
    	$users = User::join('roles','roles.id','=','users.role_id')->where('users.id','=',Auth::id())->get();
    	return view('designs.compte', compact('users'));
    }

    public function compteV(){
    	$users = User::join('roles','roles.id','=','users.role_id')->where('users.id','=',Auth::id())->get();
    	return view('designs.compteV', compact('users'));
    }

    public function flyer(){
        $propositions = Proposition::join('devis','devis.id_devi','=','propositions.id_devi')->join('documents','documents.id_document','=','devis.id_document')->orderBy('libelle_proposition','DESC')->get();
    	$devis = Devi::orderBy('date_devi','Desc')->where('valider','=',1)->get();
    	return view('designs.flyers', compact('propositions','devis'));
    }


}
