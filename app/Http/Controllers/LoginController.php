<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\RedirectTrait;   // Call the trait
use App\User;
use App\Role;
use AccountKit; 
//use Closure;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;

use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Pool;
use GuzzleHttp\Client;
//use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\RequestException;

class LoginController extends Controller
{
    //
	use AuthenticatesUsers;

    protected $numero = 'numero';
    protected $guard = 'web';
    protected $redirectTo = '/';

    public function getLogin(){

    if(Auth::guard('web')->check()){

        $user = Auth::user()->role()->first();

        //dump($user->name);

        switch ($user->name) {
		    # Admin
		    case 'Admin':
		      return redirect()->route('admin');
		      //$route = 'admin';  // the admin's route
		    break;

		    # Client
		    case 'Client':
		    return redirect()->route('client');
		      //$route = 'client'; // the client's route
		    break;

		    # Imprimeur
		    case 'Imprimeur':
		    return redirect()->route('imprimeur');
		       //$route = 'imprimeur';   // the imprimeur's route
		      break;

		    # Livreur
		    case 'Livreur':
		    return redirect()->route('livreur');
		       //$route = 'livreur';   // the livreur's route
		      break;  

		    # Design
		    case 'Design':
		    return redirect()->route('design');
		      // $route = 'design';   // the design's route
		      break;  

		    //default: return 'Cool';
		    }

            //return redirect()->route($route);
        }
        return view('/welcome');
    }

    public function postLogin(Request $request){



    	$nume = $request->numero;

    	$numeroP = str_ireplace("-", "", $nume);

    	$request->numero = "00".$request->pays.$numeroP;

        $auth = Auth::guard('web')->attempt([
            'numero' => $request->numero,
            'password' => $request->password,
            'actif' => 1
        ]);

        if($auth){

        $user = Auth::user()->role()->first();

        //dump($this->auth->check());

		//dump(Auth::guard('web'));

        switch ($user->name) {
		    # Admin
		    case 'Admin':
		    return redirect()->route('admin');
		      //$route = 'admin';  // the admin's route
		    break;

		    # Client
		    case 'Client':
		    return redirect()->route('client');
		      //$route = 'client'; // the client's route
		    break;

		    # Imprimeur
		    case 'Imprimeur':
		    return redirect()->route('imprimeur');
		       //$route = 'imprimeur';   // the imprimeur's route
		      break;

		    # Livreur
		    case 'Livreur':
		    return redirect()->route('livreur');
		       //$route = 'livreur';   // the livreur's route
		      break;  

		    # Design
		    case 'Design':
		    return redirect()->route('design');
		      // $route = 'design';   // the design's route
		      break;  

		      //default: 'login';
		    }

		    

           // return redirect()->route($route);                
            //return redirect()->route('dashboard');
        }

        return redirect()->route('/');
    }

    public function getLogout(){
        Auth::guard('web')->logout();
        return redirect()->route('/');
    }



//pas

    /**
     * $appId
     * @var [int]
     */
    protected $appId;
    /**
     * [$appSecret description]
     * @var [string]
     */
   protected $appSecret;
   /**
    * [$tokenExchangeUrl description]
    * @var [type]
    */
   protected $tokenExchangeUrl;
   /**
    * [$endPointUrl description]
    * @var [type]
    */
   protected $endPointUrl;
   /**
    * [$userAccessToken description]
    * @var [type]
    */
   public $userAccessToken;
   /**
    * [$refreshInterval description]
    * @var [type]
    */
   protected $refreshInterval;
   /**
    * [__construct description] 
    */
   public function __construct()
   {
      $this->appId            = config('accountkit.appId');
      $this->client           = new Client();
      $this->appSecret        = config('accountkit.appSecret');
      $this->endPointUrl      = config('accountkit.endPoint');
      $this->tokenExchangeUrl = config('accountkit.tokenExchangeUrl');
   }
  /**
   * [login description]
   * @param  Request $request [description]
   * @return [type]           [description]
   */
  public function login1(Request $request)
  {
      $url = $this->tokenExchangeUrl.'grant_type=authorization_code'.
              '&code='. $request->get('code').
              "&access_token=AA|$this->appId|$this->appSecret";


      $apiRequest = $this->client->request('GET', $url);
      $body = json_decode($apiRequest->getBody());
      $this->userAccessToken = $body->access_token;
      $this->refreshInterval = $body->token_refresh_interval_sec;
      return $this->getData();
  }

  public function getData()
  {
      $request = $this->client->request('GET', $this->endPointUrl.$this->userAccessToken);
      $data = json_decode($request->getBody());
      $userId = $data->id;
      $userAccessToken = $this->userAccessToken;
      $refreshInterval = $this->refreshInterval;
      $phone = isset($data->phone) ? $data->phone->number : '';
      $email = isset($data->email) ? $data->email->address : '';
      return view('index2', compact('phone', 'email', 'userId', 'userAccessToken', 'refreshInterval'));
  }

  public function index()
  {
    return view('index1');
  } 

  public function signup(){

        return view('first.signup');
    }

  public function sign(Request $request){
    $numero = $request->country.$request->phone;
        return view('first.sign', compact('numero'));
    }


// sauvegarde d'un Client
  public function saveClient(Request $request){
    $numero = str_ireplace("+", "00", $request->numero);
    
      response(User::create(['numero'=>$numero,'password'=>bcrypt($request->password),'valide'=>1,'actif'=>1,'role_id'=>2,'remember_token' => str_random(10)]));
      return view('first.login');
  }

  public function otpLogin(Request $request)
  {
      $url = $this->tokenExchangeUrl.'grant_type=authorization_code'.'&code='.$request->get('code')."&access_token=AA|$this->appId|$this->appSecret";
      $apiRequest = $this->client->request('GET', $url);
      $body = json_decode($apiRequest->getBody());
      $this->userAccessToken = $body->access_token;
      $this->refreshInterval = $body->token_refresh_interval_sec;
      return $this->getDatat();
  }

  public function getDatat()
  {
      $request = $this->client->request('GET', $this->endPointUrl.$this->userAccessToken);
      $data = json_decode($request->getBody());
      $userId = $data->id;
      $userAccessToken = $this->userAccessToken;
      $refreshInterval = $this->refreshInterval;
      $phone = isset($data->phone) ? $data->phone->number : '';
      $email = isset($data->email) ? $data->email->address : '';
      return view('first.w', compact('phone', 'userId', 'userAccessToken', 'refreshInterval'));
  }


}