<?php

namespace App\Http\Controllers; 

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Response;
use App\Devi; 
use App\Document; 
use App\Papier;
use App\Proposition;
use App\Reliure;
use App\Format;
use App\Finition;
use App\Payement;
use App\Livraison; 

class ClientController extends Controller
{ 
    // 

    public function getImage($image){
        //return "<img src='storage/ok'/>";
        $path = public_path().'/storage/'.$image;
        return Response::download($path);
    }

 
    public function commande(){
    	$documents = Document::orderBy('libelle_document','ASC')->get();
    	$papiers = Papier::orderBy('libelle_papier','ASC')->get();
    	$reliures = Reliure::orderBy('libelle_reliure','ASC')->get();
    	$formats = Format::orderBy('libelle_format','ASC')->get();
    	$finitions = Finition::orderBy('libelle_finition','ASC')->get();
    	$payements = Payement::orderBy('libelle_payement','ASC')->get();
    	$livraisons = Livraison::orderBy('libelle_livraison','ASC')->get();
    	return view('clients.commande',compact('documents','papiers','reliures','formats','finitions','payements','livraisons'));
    }


    //insertion d'un devi  
    public function postInsertCommandeC(Request $request){ 
        response(Devi::create(['libelle_devi'=>$request->libelle_devi,'titre_devi'=>$request->titre_devi,'nbre_exemplaire_devi'=>$request->nbre_exemplaire_devi,'contact1'=>$request->contact1,'contact2'=>$request->contact2,'contact3'=>$request->contact3,'adresse'=>$request->adresse,'recto_verso'=>$request->recto_verso,'couleur1'=>$request->couleur1,'couleur2'=>$request->couleur2,'couleur3'=>$request->couleur3,'couleur4'=>$request->couleur4,'date_devi'=>date("Y-m-d H:i:s"),'id_user'=>Auth::id(),'id_reliure'=>$request->id_reliure,'id_finition'=>$request->id_finition,'id_format'=>$request->id_format,'id_document'=>$request->id_document,'id_payement'=>$request->id_payement,'id_papier'=>$request->id_papier,'id_livraison'=>$request->id_livraison,'comment_devi'=>$request->comment_devi]));
    $nexmo = app('Nexmo\Client'); 
    $nexmo->message()->send([
    'to' => '22897746448',
    'from' => 'Idées',
    'text' => 'Le numero '.Auth::user()->numero.' vient de passer une commande. Titre : '.$request->titre_devi.'. Nombre d\'exemplaire '.$request->nbre_exemplaire_devi.'']);
        return back();
        
    }


    public function suivre(){

    	$id = Auth::user()->id;

    	// les commandes traitees
    	$cond1 = array('valider' => 1,'id_user' => $id);
    	$valides = Devi::where($cond1)->get();

    	$cond2 = array('impressions.valider_impression' => 1, 'id_user' => $id);
    	$imprimes = Devi::join('propositions','propositions.id_devi','=','devis.id_devi')
    						->join('impressions','impressions.id_proposition','=','propositions.id_proposition')
    						->where($cond2);

    	$cond3 = array('livrer.valider_livrer' => 1, 'id_user' => $id);
    	$livres = Devi::join('propositions','propositions.id_devi','=','devis.id_devi')
    						->join('impressions','impressions.id_proposition','=','propositions.id_proposition')
    						->join('livrer','livrer.id_impression','=','impressions.id_impression')
    						->where($cond3);

    	//les commandes non traitees
    	$cond4 = array('valider' => 0,'id_user' => $id);
    	$nonValides = Devi::where($cond4)->get();

    	$cond5 = array('impressions.valider_impression' => 0, 'id_user' => $id);
    	$nonImprimes = Devi::join('propositions','propositions.id_devi','=','devis.id_devi')
    						->join('impressions','impressions.id_proposition','=','propositions.id_proposition')
    						->where($cond5); 

    	$cond6 = array('livrer.valider_livrer' => 0, 'id_user' => $id);
    	$nonLivres = Devi::join('propositions','propositions.id_devi','=','devis.id_devi')
    						->join('impressions','impressions.id_proposition','=','propositions.id_proposition')
    						->join('livrer','livrer.id_impression','=','impressions.id_impression')
    						->where($cond6);

        $cond7 = array('montant_payer' => 0, 'id_user' =>$id);
        $nonPayes = Devi::where($cond7);

        $cond8 = array('montant_payer' => 'montant_total', 'id_user' =>$id);
        $restant = Devi::where($cond8);

        $devis = Devi::join('payements','payements.id_payement','=','devis.id_payement')->join('reliures','reliures.id_reliure','=','devis.id_reliure')->join('finitions','finitions.id_finition','=','devis.id_finition')->join('formats','formats.id_format','=','devis.id_format')->join('documents','documents.id_document','=','devis.id_document')->join('papiers','papiers.id_papier','=','devis.id_papier')->join('livraisons','livraisons.id_livraison','=','devis.id_livraison')->where('id_user','=',Auth::user()->id)->get();

    	return view('clients.suivre',compact('valides','imprimes','livres','nonValides','nonImprimes','nonLivres','nonPayes','restant','devis'));
    } 




    public function flyer(){   
    	$id = Auth::user()->id; 
    	$propositions = Proposition::join('devis','devis.id_devi','=','propositions.id_devi')->where('devis.id_user','=',$id)->where('devis.tnx_transfert','<>',0)->where('propositions.choix_client','=',NULL)->get();
    	return view('clients.flyer', compact('propositions'));
    }

    public function payer(){
        $devis = Devi::join('payements','payements.id_payement','=','devis.id_payement')->join('reliures','reliures.id_reliure','=','devis.id_reliure')->join('finitions','finitions.id_finition','=','devis.id_finition')->join('formats','formats.id_format','=','devis.id_format')->join('documents','documents.id_document','=','devis.id_document')->join('papiers','papiers.id_papier','=','devis.id_papier')->join('livraisons','livraisons.id_livraison','=','devis.id_livraison')->where('id_user','=',Auth::user()->id)->where('prix_total','<>',0)->orderBy('date_devi','DESC')->get();
        
        return view('clients.payer',compact('devis'));
    }

    public function postInsertMonatnt(Request $request){
        response(Devi::updateOrCreate(['id_devi'=>$request->id_devi],['tnx_transfert'=>$request->tnx_transfert,'date_update_devi'=>date("Y-m-d H:i:s")]));
        $nexmo = app('Nexmo\Client'); 
	    $nexmo->message()->send([
	    'to' => '22897746448',
	    'from' => 'Idées',
	    'text' => 'Le numero '.Auth::user()->numero.' vient de renseigner le code du transfert. Code : '.$request->tnx_transfert.'']);
        return back();
    }

    // editer un article
    public function editDevi(Request $request){
        if($request->ajax()){
            return response(Devi::find($request->id_devi));
        }
    }

    // editer une proposition
    public function editPropositionC(Request $request){
        if($request->ajax()){
            return response(Proposition::find($request->id_proposition));
        }
    }

    public function choixClient(Request $request){
        response(Proposition::updateOrCreate(['id_proposition'=>$request->id_proposition],['date_update_proposition'=>date("Y-m-d H:i:s"),'choix_client'=>$request->choix_client,'valider_proposition'=>1]));
        return back();
        
    }

    public function compteC(){
        return view('clients.parametre',compact(''));
    }

    public function message(){
        return view('clients.message',compact(''));
    }

    public function sendSms(){
        return view('clients.sendSms',compact(''));
    }

    public function proposC(){
        return view('clients.propos',compact(''));
    }

    public function visiteC(){
        return view('clients.visite',compact(''));
    }

    public function afficheC(){
        return view('clients.affiche',compact(''));
    }

    public function enveloppeC(){
        return view('clients.enveloppe',compact(''));
    }

    public function invitationC(){
        return view('clients.invitation',compact(''));
    }

    public function updateCommande(){
        return view('clients.updateCommande',compact(''));
    }

    public function contratC(){
        return view('clients.contrat',compact(''));
    }

    public function suivreContratC(){
        return view('clients.suivreContrat',compact(''));
    }

    public function factureC(){
        return view('clients.facture',compact(''));
    }

    public function recuC(){
        return view('clients.recu',compact(''));
    }
}
