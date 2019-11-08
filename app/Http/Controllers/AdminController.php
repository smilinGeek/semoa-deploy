<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use App\Devi;
use App\User;
use App\Article;
use App\Contrat;
use App\TypeContrat;
use App\Facture; 
use App\SousArticle;
use App\Document;
use App\Message;
use App\Livrer; 
use File;
use Storage;
use App\Papier;
use App\Reliure;
use App\Format;
use App\Finition;
use App\Payement;
use App\Livraison; 

class AdminController extends Controller 
{
    // 
    public function deviForm(){ 
        $livraisons = Livraison::orderBy('libelle_livraison','DESC')->get();
        $payements = Payement::orderBy('libelle_payement','DESC')->get();
        $formats = Format::orderBy('libelle_format','DESC')->get();
        $reliures = Reliure::orderBy('libelle_reliure','DESC')->get();
        $finitions = Finition::orderBy('libelle_finition','DESC')->get();
        $papiers = Papier::orderBy('libelle_papier','DESC')->get();
        $documents = Document::orderBy('libelle_document','DESC')->get();
    	return view('admin.devi', compact('documents','papiers','formats','reliures','finitions','payements','livraisons'));
    }

    public function getImage($image){
        $url = Storage::url($image);
        //$url2 =  '{!! HTML::image('."'".$url."'".') !!}';
        return Image::make($url)->response();
        //return $url2;
    }

    //Les routes du document
    //mettre a jour un document
    public function UploadDocument(Request $request, $nom = 'imageDocument'){
        if($request->hasFile($nom)){
            $request->file($nom);
            $photo = $request->imageDocument;
            $extension = $photo->extension();
            $name = rand(11111, 99999).".".date('Y-m-d').".".time().".".$extension;
            Storage::disk('public')->put($name, File::get($request->imageDocument));
            return $name;
        }else{
            return 'Aucun fichier selectionner';
        }
        
    }

    // editer un document
    public function editDocument(Request $request){
        if($request->ajax()){
            return response(Document::find($request->id_document));
        }
    }

    //mettre a jours un document
    public function updateDocument(Request $request){
        if($request->ajax()){
            return response(MyClass::updateOrCreate(['id_document'=>$request->id_document], $request->all()));
        }
    }

    //insertion d'un document
    public function postInsertDocument(Request $request){
       $temp = $this->UploadDocument($request);
        response(Document::create(['libelle_document'=>$request->libelle_document,'prixUnitaire_document'=>$request->prixUnitaire_document,'imageDocument'=>$temp]));
        return back();
        
    }
    //supprimer un document
    public function deleteDocument(Request $request){
        if($request->ajax()){
            Document::destroy($request->id_document);
        }
    }

    //Les routes du papier
    //uploader un papier 
    public function UploadPapier(Request $request, $nom = 'imagePapier'){
        if($request->hasFile($nom)){
            $request->file($nom);
            $photo = $request->imagePapier;
            $extension = $photo->extension();
            $name = rand(11111, 99999).".".date('Y-m-d').".".time().".".$extension;
            Storage::disk('public')->put($name, File::get($request->imagePapier));
            return $name;
        }else{
            return 'Pas d\'image';
        }
        
    }

    // editer un papier
    public function editPapier(Request $request){
        if($request->ajax()){
            return response(Papier::find($request->id_papier));
        }
    }

    //mettre a jours un papier
    public function updatePapier(Request $request){
        if($request->ajax()){
            return response(Papier::updateOrCreate(['id_papier'=>$request->id_papier], $request->all()));
        }
    }

    //insertion d'un papier
    public function postInsertPapier(Request $request){
       $temp = $this->UploadPapier($request);
        response(Papier::create(['libelle_papier'=>$request->libelle_papier,'prixUnitaire_papier'=>$request->prixUnitaire_papier,'imagePapier'=>$temp]));
        return back();
        
    }

    //supprimer un papier
    public function deletePapier(Request $request){
        if($request->ajax()){
            Papier::destroy($request->id_papier);
        }
    }

    //Les routes du format
    //uploader un format 
    public function UploadFormat(Request $request, $nom = 'imageFormat'){
        if($request->hasFile($nom)){
            $request->file($nom);
            $photo = $request->imageFormat;
            $extension = $photo->extension();
            $name = rand(11111, 99999).".".date('Y-m-d').".".time().".".$extension;
            Storage::disk('public')->put($name, File::get($request->imageFormat));
            return $name;
        }else{
            return 'Pas d\'image';
        }
        
    }

    // editer un format
    public function editFormat(Request $request){
        if($request->ajax()){
            return response(Format::find($request->id_format));
        }
    }

    //mettre a jours un format
    public function updateFormat(Request $request){
        if($request->ajax()){
            return response(Format::updateOrCreate(['id_format'=>$request->id_format], $request->all()));
        }
    }

    //insertion d'un format
    public function postInsertFormat(Request $request){
       $temp = $this->UploadFormat($request);
        response(Format::create(['libelle_format'=>$request->libelle_format,'prixUnitaire_format'=>$request->prixUnitaire_format,'imageFormat'=>$temp]));
        return back();
        
    }
    //supprimer un format
    public function deleteFormat(Request $request){
        if($request->ajax()){
            Format::destroy($request->id_format);
        }
    }


    //Les routes du reliure
    //uploader un reliure 
    public function UploadReliure(Request $request, $nom = 'imageReliure'){
        if($request->hasFile($nom)){
            $request->file($nom);
            $photo = $request->imageReliure;
            $extension = $photo->extension();
            $name = rand(11111, 99999).".".date('Y-m-d').".".time().".".$extension;
            Storage::disk('public')->put($name, File::get($request->imageReliure));
            return $name;
        }else{
            return 'Pas d\'image';
        }
        
    }

    // editer un reliure
    public function editReliure(Request $request){
        if($request->ajax()){
            return response(Reliure::find($request->id_reliure));
        }
    }

    //mettre a jours un reliure
    public function updateReliure(Request $request){
        if($request->ajax()){
            return response(Reliure::updateOrCreate(['id_reliure'=>$request->id_reliure], $request->all()));
        }
    }

    //insertion d'un reliure
    public function postInsertReliure(Request $request){
       $temp = $this->UploadReliure($request);
        response(Reliure::create(['libelle_reliure'=>$request->libelle_reliure,'prixUnitaire_reliure'=>$request->prixUnitaire_reliure,'imageReliure'=>$temp]));
        return back();
        
    }
    //supprimer un reliure
    public function deleteReliure(Request $request){
        if($request->ajax()){
            Reliure::destroy($request->id_reliure);
        }
    }

    //Les routes du finition
    //uploader un finition 
    public function UploadFinition(Request $request, $nom = 'imageFinition'){
        if($request->hasFile($nom)){
            $request->file($nom);
            $photo = $request->imageFinition;
            $extension = $photo->extension();
            $name = rand(11111, 99999).".".date('Y-m-d').".".time().".".$extension;
            Storage::disk('public')->put($name, File::get($request->imageFinition));
            return $name;
        }else{
            return 'Pas d\'image';
        }
        
    }

    // editer un finition
    public function editFinition(Request $request){
        if($request->ajax()){
            return response(Finition::find($request->id_finition));
        }
    }

    //mettre a jours un finition
    public function updateFinition(Request $request){
        if($request->ajax()){
            return response(Finition::updateOrCreate(['id_finition'=>$request->id_finition], $request->all()));
        }
    }

    //insertion d'un finition
    public function postInsertFinition(Request $request){
       $temp = $this->UploadFinition($request);
        response(Finition::create(['libelle_finition'=>$request->libelle_finition,'prixUnitaire_finition'=>$request->prixUnitaire_finition,'imageFinition'=>$temp]));
        return back();
        
    }
    //supprimer un finition
    public function deleteFinition(Request $request){
        if($request->ajax()){
            Finition::destroy($request->id_finition);
        }
    }

    //Les routes du livraison
    // editer un livraison
    public function editLivraison(Request $request){
        if($request->ajax()){
            return response(Livraison::find($request->id_livraison));
        }
    }
 
    //mettre a jours un livraison
    public function updateLivraison(Request $request){
        if($request->ajax()){
            return response(Livraison::updateOrCreate(['id_livraison'=>$request->id_livraison], $request->all()));
        }
    }

    //insertion d'un livraison
    public function postInsertLivraison(Request $request){
        response(Livraison::create(['libelle_livraison'=>$request->libelle_livraison]));
        return back();
        
    }
    //supprimer un livraison
    public function deleteLivraison(Request $request){
        if($request->ajax()){
            Livraison::destroy($request->id_livraison);
        }
    }

    //Les routes du payement
    // editer un payement
    public function editPayement(Request $request){
        if($request->ajax()){
            return response(Payement::find($request->id_payement));
        }
    }

    //mettre a jours un payement
    public function updatePayement(Request $request){
        if($request->ajax()){
            return response(Payement::updateOrCreate(['id_payement'=>$request->id_payement], ['libelle_payement'=>$request->libelle_payement]));
        }
    }

    //insertion d'un payement
    public function postInsertPayement(Request $request){
        response(Payement::create(['libelle_payement'=>$request->libelle_payement]));
        return back();
        
    }
    //supprimer un payement
    public function deletePayement(Request $request){
        if($request->ajax()){
            Payement::destroy($request->id_payement);
        }
    }




/// Article

    public function article(){
        $sousArticles = sousArticle::join('articles','articles.id_article','=','sousArticles.id_article')->get();
    	$articles = Article::orderBy('titre_article','DESC')->get();
    	return view('admin.article', compact('articles','sousArticles'));
    }

    //Les routes du article
    //uploader un article
    public function UploadArticle(Request $request, $nom = 'image_article'){
        if($request->hasFile($nom)){
            $request->file($nom);
            $photo = $request->image_article;
            $extension = $photo->extension();
            $name = rand(11111, 99999).".".date('Y-m-d').".".time().".".$extension;
            Storage::disk('public')->put($name, File::get($request->image_article));
            return $name;
        }else{
            return '';
        }
        
    }

    // editer un article
    public function editArticle(Request $request){
        if($request->ajax()){
            return response(Article::find($request->id_article));
        }
    }

    //mettre a jours un article 
    public function updateArticle(Request $request){
        if($request->ajax()){
            return response(Article::updateOrCreate(['id_article'=>$request->id_article], $request->all()));
        }
    }

    //insertion d'un article
    public function postInsertArticle(Request $request){
       $temp = $this->UploadArticle($request);
        response(Article::create(['titre_article'=>$request->titre_article,'contenu_article'=>$request->contenu_article,'poster_article'=>$request->poster_article,'image_article'=>$temp,'id_user'=>Auth::id()]));
        return back();
        
    }
    //supprimer un article
    public function deleteArticle(Request $request){
        if($request->ajax()){
            Article::destroy($request->id_article);
        }
    }


    //Les routes du sousArticle
    //uploader un sousArticle
    public function UploadSousArticle(Request $request, $nom = 'image_sousArticle'){
        if($request->hasFile($nom)){
            $request->file($nom);
            $photo = $request->image_sousArticle;
            $extension = $photo->extension();
            $name = rand(11111, 99999).".".date('Y-m-d').".".time().".".$extension;
            Storage::disk('public')->put($name, File::get($request->image_sousArticle));
            return $name;
        }else{
            return '';
        }
        
    }

    // editer un sousArticle
    public function editSousArticle(Request $request){
        if($request->ajax()){
            return response(sousArticle::find($request->id_sousArticle));
        }
    }

    //mettre a jours un sousArticle
    public function updateSousArticle(Request $request){
        if($request->ajax()){
            return response(sousArticle::updateOrCreate(['id_sousArticle'=>$request->id_sousArticle], $request->all()));
        }
    }

    //insertion d'un sousArticle
    public function postInsertSousArticle(Request $request){
       $temp = $this->UploadSousArticle($request);
        response(sousArticle::create(['titre_sousArticle'=>$request->titre_sousArticle,'contenu_sousArticle'=>$request->contenu_sousArticle,'poster_sousArticle'=>$request->poster_sousArticle,'image_sousArticle'=>$temp,'id_article'=>$request->id_article]));
        return back();
        
    }
    //supprimer un article
    public function deleteSousArticle(Request $request){
        if($request->ajax()){
            sousArticle::destroy($request->id_sousArticle);
        }
    }




/////Les route du message
    public function message(){
        $messages = Message::join('users','users.id','=','messages.id_user')->get();
        return view('admin.message', compact('messages'));
    }



// Les routes du facture
    public function facture(){
        $factures = Facture::join('devis','devis.id_devi','=','factures.id_devi')->join('Livrer','livrer.id_livrer','factures.id_livrer')->get();
        $livres = Livrer::orderBy('libelle_livrer','DESC')->get();
        $devis = Devi::orderBy('titre_devi','DESC')->get();  
        return view('admin.facture', compact('livres','devis','factures'));
    }
 
    /// les contrat
    public function contrat(){
        $users = User::join('roles','roles.id','=','users.role_id')->where('role_id','=',2)->get();
        $typeContrats = TypeContrat::orderBy('libelle_typeContrat','DESC')->get();
        $contrats = Contrat::join('typeContrat','typeContrat.id_typeContrat','=','contrats.id_typeContrat')->join('users','users.id','=','contrats.id_user')->get();
        return view('admin.contrat', compact('typeContrats','contrats','users'));
    }

     //Les routes du typeContrat
    // editer un typeContrat 
    public function editTypeContrat(Request $request){
        if($request->ajax()){
            return response(TypeContrat::find($request->id_typeContrat));
        }
    }

    //mettre a jours un typeContrat
    public function updateTypeContrat(Request $request){
        if($request->ajax()){ 
            return response(TypeContrat::updateOrCreate(['id_typeContrat'=>$request->id_typeContrat], ['libelle_typeContrat'=>$request->libelle_typeContrat,'validite_contrat'=>$request->validite_contrat]));
        }
    }

    //insertion d'un typeContrat
    public function postInsertTypeContrat(Request $request){
        response(TypeContrat::create(['libelle_typeContrat'=>$request->libelle_typeContrat,'validite_contrat'=>$request->validite_contrat]));
        return back();
        
    }
    //supprimer un typeContrat
    public function deleteTypeContrat(Request $request){
        if($request->ajax()){
            TypeContrat::destroy($request->id_typeContrat);
        }
    }


    //Les routes du contrat
    // editer un contrat
    public function editContrat(Request $request){
        if($request->ajax()){
            return response(Contrat::find($request->id_contrat));
        }
    }

    //mettre a jours un contrat
    public function updateContrat(Request $request){ 
        if($request->ajax()){
            return response(Contrat::updateOrCreate(['id_contrat'=>$request->id_contrat], ['libelle_contrat'=>$request->libelle_contrat,'remise_contrat'=>$request->remise_contrat,'montant_contrat'=>$request->montant_contrat,'date_rompre'=>$request->date_rompre,'id_user'=>$request->id_user,'id_typeContrat'=>$request->id_typeContrat]));
        }
    }

    //insertion d'un contrat
    public function postInsertContrat(Request $request){
        response(Contrat::create(['libelle_contrat'=>$request->libelle_contrat,'remise_contrat'=>$request->remise_contrat,'montant_contrat'=>$request->montant_contrat,'date_signer'=>$request->date_signer,'date_rompre'=>$request->date_rompre,'id_user'=>$request->id_user,'id_typeContrat'=>$request->id_typeContrat]));
        return back();
        
    }
    //supprimer un contrat
    public function deleteContrat(Request $request){
        if($request->ajax()){
            Contrat::destroy($request->id_contrat);
        }
    }

    //get utiliateur
    public function users(){
        $users = User::join('roles','roles.id','=','users.role_id')->orwhere('role_id','=',3)->orwhere('role_id','=',4)->orwhere('role_id','=',5)->orwhere('role_id','=',1)->get();
        return view('admin.users', compact('users'));
    }

    //Les routes du user
    //uploader un user 
    public function UploadUser(Request $request, $nom = 'avatar'){
        if($request->hasFile($nom)){
            $request->file($nom);
            $photo = $request->avatar;
            $extension = $photo->extension();
            $name = rand(11111, 99999).".".date('Y-m-d').".".time().".".$extension;
            Storage::disk('public')->put($name, File::get($request->avarat));
            return $name;
        }else{
            return '';
        }
        
    }

    // editer un user
    public function editUser(Request $request){
        if($request->ajax()){
            return response(User::find($request->id));
        }
    }

    //mettre a jours un user
    public function updateUser(Request $request){
        if($request->ajax()){
            return response(User::updateOrCreate(['id'=>$request->id], $request->all()));
        }
    }

    //insertion d'un user
    public function postInsertUser(Request $request){
       $temp = $this->UploadUser($request);
        response(User::create(['numero'=>$request->numero,'password'=>bcrypt($request->password),'nom'=>$request->nom,'prenom'=>$request->prenom,'adresse_user'=>$request->adresse_user,'email'=>$request->email,'valide'=>1,'actif'=>$request->actif,'role_id'=>$request->role_id,'remember_token' => str_random(10),'avatar'=>$temp]));
        return back();
        
    }
    //supprimer un user
    public function deleteUser(Request $request){
        if($request->ajax()){
            User::destroy($request->id);
        }
    }

    public function manageUsers(){
        $users = User::join('roles','roles.id','=','users.role_id')->where('role_id','<>',1)->get();    
        return view('admin.usersmanage', compact('users'));
    }

    //activer un utilisateur
    public function activerUser(Request $request){
           return response(User::update(['id'=>$request->id], ['actif'=>$request->actif]));
    } 

    //desactiver un utilisateur 
    public function desactiverUser(Request $request){
            return response(User::updateOrCreate(['id'=>$request->id], ['actif'=>$request->actif]));
    }

    public function compteV(){  
    $users = User::join('roles','roles.id','=','users.role_id')->where('users.id','=',Auth::id())->get();
    $avatar = User::where('id','=',Auth::id())->select('avatar')->get();
    $photo_user = Storage::url($avatar);    
        return view('admin.compteV', compact('users','photo_user')); 
    }


    public function compte(){ 
    $users = User::join('roles','roles.id','=','users.role_id')->where('users.id','=',Auth::id())->get();
    $avatar = User::where('id','=',Auth::id())->select('avatar')->get();
    $photo_user = Storage::url($avatar); 
    	return view('admin.compte', compact('users','photo_user')); 
    }
 
    //mettre a jours un compte
    public function updateCompte(Request $request){ 
            response(User::updateOrCreate(['id'=>$request->id], ['nom'=>$request->nom,'prenom'=>$request->prenom,'adresse_user'=>$request->adresse_user,'email'=>$request->email]));
            return view('admin.compteV');
    }

     public function commande(){
        $devis = Devi::join('documents','documents.id_document','=','devis.id_document')->join('payements','payements.id_payement','=','devis.id_payement')->join('formats','formats.id_format','=','devis.id_format')->join('reliures','reliures.id_reliure','=','devis.id_reliure')->join('finitions','finitions.id_finition','=','devis.id_finition')->join('papiers','papiers.id_papier','=','devis.id_papier')->join('users','users.id','=','devis.id_user')->join('livraisons','livraisons.id_livraison','=','devis.id_livraison')->orWhere('devis.prix_total','=',0)->orWhere('devis.prix_total','=',NULL)->orderBy('id_devi','DESC')->get();
        $validers = Devi::join('documents','documents.id_document','=','devis.id_document')->join('payements','payements.id_payement','=','devis.id_payement')->join('formats','formats.id_format','=','devis.id_format')->join('reliures','reliures.id_reliure','=','devis.id_reliure')->join('finitions','finitions.id_finition','=','devis.id_finition')->join('papiers','papiers.id_papier','=','devis.id_papier')->join('livraisons','livraisons.id_livraison','=','devis.id_livraison')->Where('devis.prix_total','<>',0)->where('devis.tnx_transfert','<>',0)->orderBy('id_devi','DESC')->get();
        return view('admin.commande', compact('devis','validers'));
    }

    public function editPrix(Request $request){ 
        if($request->ajax()){
            return response(Devi::find($request->id_devi));
        }
    }

    public function editValider(Request $request){
        if($request->ajax()){
            return response(Devi::find($request->id_devi));
        }
    }

    public function postInsertPrix(Request $request){
        response(Devi::updateOrCreate(['id_devi'=>$request->id_devi],['prix_total'=>$request->prix_total,'remise_devi'=>$request->remise_devi,'date_update_devi'=>date("Y-m-d H:i:s")]));
        return back();
    }

    public function postInsertValider(Request $request){
        response(Devi::updateOrCreate(['id_devi'=>$request->id_devi1],['valider'=>$request->valider,'date_update_devi'=>date("Y-m-d H:i:s")]));
        return back();
    }

    public function recuAdmin(){

        return view('admin.recu'); 
    }

}
