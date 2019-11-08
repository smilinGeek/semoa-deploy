<?php
 
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/mes',function(){
	$nexmo = app('Nexmo\Client');  
	$nexmo->message()->send([
    'to' => '22897746448',
    'from' => 'Idees',
    'text' => 'Le numero 0022890515928 vient de passer une commande, voici en les details.'
	]);

}); 

Route::get('/ave', function(){
	$url = Storage::url('28211.2017-09-24.1506283676.jpeg');
	$n = '28211.2017-09-24.1506283676.jpeg';
	return "<img src='storage/28442.2017-10-04.1507107156.png'/>"; 
	//"<img src='storage/".$n."'/>";
	//"<img src='storage/28211.2017-09-24.1506283676.jpeg'/>";//"<img src='".$url."'/>"; 
	//$url;
	//"<img src='{{ asset('/storage/zuck.png') }}'/>";
});

//Route::post('/otp-login', 'LoginController@otpLogin');

Route::post('/otp-login', ['uses' => 'LoginController@otpLogin', 'as' => 'otpLogin']);


// les route de la page sans connexion 
Route::get('/index1', ['uses' => 'LoginController@index', 'as' => 'index1']);

Route::get('/index2', ['uses' => 'LoginController@index2', 'as' => 'index2']);

Route::post('/login1', ['uses' => 'LoginController@login1', 'as' => 'login1']);

Route::get('/signup', ['as' => 'signup', 'uses' => 'LoginController@signup']);

Route::post('/sign', ['as' => 'sign', 'uses' => 'LoginController@sign']);

Route::post('/createur/connect', ['as' => 'saveClient', 'uses' => 'LoginController@saveClient']);



Route::get('/affiche', ['as' => 'affiche', 'uses' => 'DashboardController@affiche']);

Route::get('/commande', ['as' => 'commande', 'uses' => 'DashboardController@commande']);

Route::get('/contact', ['as' => 'contact', 'uses' => 'DashboardController@contact']);

Route::get('/enveloppe', ['as' => 'enveloppe', 'uses' => 'DashboardController@enveloppe']);

Route::get('/home', ['as' => 'home', 'uses' => 'DashboardController@home']);

Route::get('/invitation', ['as' => 'invitation', 'uses' => 'DashboardController@invitation']);

Route::get('/login', ['as' => 'login', 'uses' => 'DashboardController@login']);

Route::get('/propos', ['as' => 'propos', 'uses' => 'DashboardController@propos']);

Route::get('/visite', ['as' => 'visite', 'uses' => 'DashboardController@visite']);


Route::get('/',['as' => '/','uses' => 'LoginController@getLogin']);

Route::get('/index', ['as' => 'index', 'uses' => 'DashboardController@index']);

Route::post('/login', ['as' => 'login', 'uses' => 'LoginController@postLogin']);

// route de permission pour visiter une page
Route::get('/noPermission',function(){
    return view('permission.noPermission');
}); 
 

Route::group(['middleware' => ['authen']],function(){
    Route::get('/logout', ['as' => 'logout', 'uses' => 'LoginController@getLogout']);
}); 
 
Route::group(['middleware' => ['authen', 'roles'], 'roles' => ['Admin']], function(){
	Route::get('/admin', ['as' => 'admin', 'uses' => 'DashboardController@admin']);
	Route::get('/admin/deviForm', ['as' => 'deviForm', 'uses' => 'AdminController@deviForm']);
	Route::get('/admin/article', ['as' => 'article', 'uses' => 'AdminController@article']);
	Route::get('/admin/commande', ['as' => 'commandeA', 'uses' => 'AdminController@commande']);
	Route::get('/admin/message', ['as' => 'messageA', 'uses' => 'AdminController@message']);
	Route::get('/admin/facture', ['as' => 'factureA', 'uses' => 'AdminController@facture']);
	Route::get('/admin/contrat', ['as' => 'contratA', 'uses' => 'AdminController@contrat']);
	Route::get('/admin/compte', ['as' => 'compteViewA', 'uses' => 'AdminController@compteV']);
	Route::get('/admin/compte/update', ['as' => 'compteA', 'uses' => 'AdminController@compte']);
	Route::get('/admin/users', ['as' => 'users', 'uses' => 'AdminController@users']);
	Route::get('/admin/users/manage', ['as' => 'manageUsers', 'uses' => 'AdminController@manageUsers']);
	Route::get('/admin/deviForm/{image}', ['as' => '{image}', 'uses' => 'AdminController@getImage']);
	Route::get('/admin/recu', ['as' => 'recuAdmin', 'uses' => 'AdminController@recuAdmin']);
	//route du document
	Route::get('/admin/deviForm/manage/editDocument', ['as' => 'editDocument', 'uses' => 'AdminController@editDocument']);
	Route::post('/admin/deviForm/insert-document', ['as' => 'postInsertDocument', 'uses' => 'AdminController@postInsertDocument']);
	Route::post('/admin/deviForm/delete-document', ['as' => 'deleteDocument', 'uses' => 'AdminController@deleteDocument']);
	Route::post('/admin/deviForm/update-document', ['as' => 'updateDocument', 'uses' => 'AdminController@updateDocument']);
	// route du papier
	Route::get('/admin/deviForm/manage/editPapier', ['as' => 'editPapier', 'uses' => 'AdminController@editPapier']);
	Route::post('/admin/deviForm/insert-papier', ['as' => 'postInsertPapier', 'uses' => 'AdminController@postInsertPapier']);
	Route::post('/admin/deviForm/delete-papier', ['as' => 'deletePapier', 'uses' => 'AdminController@deletePapier']);
	Route::post('/admin/deviForm/update-papier', ['as' => 'updatePapier', 'uses' => 'AdminController@updatePapier']);
	// route du format
	Route::get('/admin/deviForm/manage/editFormat', ['as' => 'editFormat', 'uses' => 'AdminController@editFormat']);
	Route::post('/admin/deviForm/insert-format', ['as' => 'postInsertFormat', 'uses' => 'AdminController@postInsertFormat']);
	Route::post('/admin/deviForm/delete-format', ['as' => 'deleteFormat', 'uses' => 'AdminController@deleteFormat']);
	Route::post('/admin/deviForm/update-format', ['as' => 'updateFormat', 'uses' => 'AdminController@updateFormat']);
	// route du reliure
	Route::get('/admin/deviForm/manage/editReliure', ['as' => 'editReliure', 'uses' => 'AdminController@editReliure']);
	Route::post('/admin/deviForm/insert-reliure', ['as' => 'postInsertReliure', 'uses' => 'AdminController@postInsertReliure']);
	Route::post('/admin/deviForm/delete-reliure', ['as' => 'deleteReliure', 'uses' => 'AdminController@deleteReliure']);
	Route::post('/admin/deviForm/update-reliure', ['as' => 'updateReliure', 'uses' => 'AdminController@updateReliure']);
	// route du finition 
	Route::get('/admin/deviForm/manage/editFinition', ['as' => 'editFinition', 'uses' => 'AdminController@editFinition']);
	Route::post('/admin/deviForm/insert-finition', ['as' => 'postInsertFinition', 'uses' => 'AdminController@postInsertFinition']);
	Route::post('/admin/deviForm/delete-finition', ['as' => 'deleteFinition', 'uses' => 'AdminController@deleteFinition']);
	Route::post('/admin/deviForm/update-finition', ['as' => 'updateFinition', 'uses' => 'AdminController@updateFinition']);
	// route du livraison
	Route::get('/admin/deviForm/manage/editLivraison', ['as' => 'editLivraison', 'uses' => 'AdminController@editLivraison']);
	Route::post('/admin/deviForm/insert-livraison', ['as' => 'postInsertLivraison', 'uses' => 'AdminController@postInsertLivraison']);
	Route::post('/admin/deviForm/delete-livraison', ['as' => 'deleteLivraison', 'uses' => 'AdminController@deleteLivraison']);
	Route::post('/admin/deviForm/update-livraison', ['as' => 'updateLivraison', 'uses' => 'AdminController@updateLivraison']);
	// route du payement
	Route::get('/admin/deviForm/manage/editPayement', ['as' => 'editPayement', 'uses' => 'AdminController@editPayement']);
	Route::post('/admin/deviForm/insert-payement', ['as' => 'postInsertPayement', 'uses' => 'AdminController@postInsertPayement']);
	Route::post('/admin/deviForm/delete-payement', ['as' => 'deletePayement', 'uses' => 'AdminController@deletePayement']);
	Route::post('/admin/deviForm/update-payement', ['as' => 'updatePayement', 'uses' => 'AdminController@updatePayement']);
	// route du article 
	Route::get('/admin/article/editArticle', ['as' => 'editArticle', 'uses' => 'AdminController@editArticle']);
	Route::post('/admin/article/insert-article', ['as' => 'postInsertArticle', 'uses' => 'AdminController@postInsertArticle']);
	Route::post('/admin/article/delete-article', ['as' => 'deleteArticle', 'uses' => 'AdminController@deleteArticle']);
	Route::post('/admin/article/update-article', ['as' => 'updateArticle', 'uses' => 'AdminController@updateArticle']);
	// route du sousArticle
	Route::get('/admin/article/editSousArticle', ['as' => 'editSousArticle', 'uses' => 'AdminController@editSousArticle']);
	Route::post('/admin/article/insert-sousArticle', ['as' => 'postInsertSousArticle', 'uses' => 'AdminController@postInsertSousArticle']);
	Route::post('/admin/article/delete-sousArticle', ['as' => 'deleteSousArticle', 'uses' => 'AdminController@deleteSousArticle']);
	Route::post('/admin/article/update-sousArticle', ['as' => 'updateSousArticle', 'uses' => 'AdminController@updateSousArticle']);
	// route du typeContrat 
	Route::get('/admin/contrat/editTypeContrat', ['as' => 'editTypeContrat', 'uses' => 'AdminController@editTypeContrat']);
	Route::post('/admin/contrat/insert-typeContrat', ['as' => 'postInsertTypeContrat', 'uses' => 'AdminController@postInsertTypeContrat']);
	Route::post('/admin/contrat/delete-typeContrat', ['as' => 'deleteTypeContrat', 'uses' => 'AdminController@deleteTypeContrat']);
	Route::post('/admin/contrat/update-typeContrat', ['as' => 'updateTypeContrat', 'uses' => 'AdminController@updateTypeContrat']);
	// route du contrat
	Route::get('/admin/contrat/manage/editContrat', ['as' => 'editContrat', 'uses' => 'AdminController@editContrat']);
	Route::post('/admin/contrat/insert-contrat', ['as' => 'postInsertContrat', 'uses' => 'AdminController@postInsertContrat']);
	Route::post('/admin/contrat/delete-contrat', ['as' => 'deleteContrat', 'uses' => 'AdminController@deleteContrat']);
	Route::post('/admin/contrat/update-contrat', ['as' => 'updateContrat', 'uses' => 'AdminController@updateContrat']);
	// route du user 
	Route::get('/admin/users/editUser', ['as' => 'editUser', 'uses' => 'AdminController@editUser']);  
	Route::post('/admin/users/insert-users', ['as' => 'postInsertUser', 'uses' => 'AdminController@postInsertUser']);
	Route::post('/admin/users/delete-user', ['as' => 'deleteUser', 'uses' => 'AdminController@deleteUser']);
	Route::post('/admin/users/update-user', ['as' => 'updateUser', 'uses' => 'AdminController@updateUser']);
	Route::post('/admin/users/manage/activer-user', ['as' => 'activerUser', 'uses' => 'AdminController@activerUser']);
	Route::post('/admin/users/manage/desactiver-user', ['as' => 'desactiverUser', 'uses' => 'AdminController@desactiverUser']);
	Route::post('/admin/compte/update-compte', ['as' => 'updateCompte', 'uses' => 'AdminController@updateCompte']);
	//
	Route::post('/admin/commande/insert-prix', ['as' => 'postInsertPrix', 'uses' => 'AdminController@postInsertPrix']);
	Route::get('/admin/commande/editPrix', ['as' => 'editPrix', 'uses' => 'AdminController@editPrix']);
	//
	Route::post('/admin/commande/insert-valider', ['as' => 'postInsertValider', 'uses' => 'AdminController@postInsertValider']);
	Route::get('/admin/commande/editValider', ['as' => 'editValider', 'uses' => 'AdminController@editValider']);
	});    
 
Route::group(['middleware' => ['authen', 'roles'], 'roles' => ['Client']], function(){
	Route::get('/client', ['as' => 'client', 'uses' => 'DashboardController@client']);
	Route::get('/client/flyer/{image}', ['as' => '{image}', 'uses' => 'ClientController@getImage']);
	Route::get('/client/commande', ['as' => 'commande', 'uses' => 'ClientController@commande']);
	Route::get('/client/suivre', ['as' => 'suivre', 'uses' => 'ClientController@suivre']);
	Route::get('/client/flyer', ['as' => 'flyer', 'uses' => 'ClientController@flyer']);
	Route::get('/client/payer/commande', ['as' => 'payer', 'uses' => 'ClientController@payer']);
	Route::get('/client/compte/client', ['as' => 'compteC', 'uses' => 'ClientController@compteC']);
	Route::get('/client/message', ['as' => 'message', 'uses' => 'ClientController@message']);
	Route::get('/client/propos', ['as' => 'proposC', 'uses' => 'ClientController@proposC']);
	Route::get('/client/message/sendSms', ['as' => 'sendSms', 'uses' => 'ClientController@sendSms']);
	Route::get('/client/visite', ['as' => 'visiteC', 'uses' => 'ClientController@visiteC']);  
	Route::get('/client/affiche', ['as' => 'afficheC', 'uses' => 'ClientController@afficheC']);
	Route::get('/client/enveloppe', ['as' => 'enveloppeC', 'uses' => 'ClientController@enveloppeC']);
	Route::get('/client/invitation', ['as' => 'invitationC', 'uses' => 'ClientController@invitationC']);
	Route::get('/client/commande/update', ['as' => 'updateCommande', 'uses' => 'ClientController@updateCommande']);
	Route::get('/client/contrat', ['as' => 'contratC', 'uses' => 'ClientController@contratC']);
	Route::get('/client/contrat/suivre', ['as' => 'suivreContratC', 'uses' => 'ClientController@suivreContratC']);
	Route::get('/client/facture', ['as' => 'factureC', 'uses' => 'ClientController@factureC']);
	Route::get('/client/recu', ['as' => 'recuC', 'uses' => 'ClientController@recuC']);
	Route::post('/client/commande/insert-commande', ['as' => 'postInsertCommandeC', 'uses' => 'ClientController@postInsertCommandeC']);
	Route::get('/client/commande/editDevi', ['as' => 'editDevi', 'uses' => 'ClientController@editDevi']);
	Route::post('/client/commande/insert-prix', ['as' => 'postInsertMonatnt', 'uses' => 'ClientController@postInsertMonatnt']);
	//
	Route::get('/client/commande/editPropositionC', ['as' => 'editPropositionC', 'uses' => 'ClientController@editPropositionC']);
	Route::post('/client/commande/insert-choixClient', ['as' => 'choixClient', 'uses' => 'ClientController@choixClient']);
	});    

Route::group(['middleware' => ['authen', 'roles'], 'roles' => ['Design']], function(){
	Route::get('/design', ['as' => 'design', 'uses' => 'DashboardController@design']);
	Route::get('/design/compte', ['as' => 'compteD', 'uses' => 'DesignController@compte']);
	Route::get('/design/compte/update', ['as' => 'compteViewD', 'uses' => 'DesignController@compteV']);
	Route::get('/design/flyer', ['as' => 'flyerD', 'uses' => 'DesignController@flyer']);
	Route::post('/design/proposition/insert-flyer', ['as' => 'postInsertProposition', 'uses' => 'DesignController@postInsertProposition']);
	Route::get('/design/flyer/editDeviD', ['as' => 'editDeviD', 'uses' => 'DesignController@editDeviD']);
	});

Route::group(['middleware' => ['authen', 'roles'], 'roles' => ['Livreur']], function(){
	Route::get('/livreur', ['as' => 'livreur', 'uses' => 'DashboardController@livreur']);
	Route::get('/livreur/compte', ['as' => 'compteL', 'uses' => 'LivreurController@compte']);
	Route::get('/livreur/livrer', ['as' => 'livrer', 'uses' => 'LivreurController@livrer']);
	Route::get('/livreur/compte/update', ['as' => 'compteViewL', 'uses' => 'LivreurController@compteV']);
	Route::post('/livreur/proposition/insert-impression', ['as' => 'postInsertLivrer', 'uses' => 'LivreurController@postInsertLivrer']);
	Route::get('/livreur/impression/editImpressionL', ['as' => 'editImpressionL', 'uses' => 'LivreurController@editImpressionL']);
	});

Route::group(['middleware' => ['authen', 'roles'], 'roles' => ['Imprimeur']], function(){
	Route::get('/imprimeur', ['as' => 'imprimeur', 'uses' => 'DashboardController@imprimeur']);
	Route::get('/imprimeur/flyer/{image}', ['as' => '{image}', 'uses' => 'ImprimeurController@getImage']);
	Route::get('/imprimeur/compte', ['as' => 'compteI', 'uses' => 'ImprimeurController@compte']);
	Route::get('/imprimeur/impression', ['as' => 'impression', 'uses' => 'ImprimeurController@impression']);
	Route::get('/imprimeur/compte/update', ['as' => 'compteViewI', 'uses' => 'ImprimeurController@compteV']);
	Route::post('/imprimeur/proposition/insert-impression', ['as' => 'postInsertImpression', 'uses' => 'ImprimeurController@postInsertImpression']);
	Route::get('/imprimeur/impression/editPropositionI', ['as' => 'editPropositionI', 'uses' => 'ImprimeurController@editPropositionI']);
	});



