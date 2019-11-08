<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Devi;
use App\Impression;
use App\Livrer;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    public function __construct(){
        $this->middleware('web');
    }

    // les chemin sans login

    public function affiche(){
        return view('first.affiche');
    }

    public function commande(){
        return view('first.commande');
    }

    public function contact(){
        return view('first.contact');
    }

    public function enveloppe(){
        return view('first.enveloppe');
    }

    public function home(){
        return view('first.home');
    }

    public function invitation(){
        return view('first.invitation');
    }

    public function login(){
        return view('first.login');
    }

    public function propos(){
        return view('first.propos');
    }

    public function visite(){
        return view('first.visite');
    }

    // les chemin d'apres login

    public function client(){
    $users = User::where('users.id','=',Auth::id())->get();
        return view('clients.home',compact('users'));
    }

    public function admin(){
    $nbClient = User::count('id');
    $nbDevi = Devi::count('id_devi');
    $nbImpression = Impression::count('id_impression');
    $nbLivrer = Livrer::count('id_livrer');
    $users = User::where('users.id','=',Auth::id())->get();
        return view('admin.home', compact('users','nbClient','nbDevi','nbImpression','nbLivrer'));
    }

    public function design(){
    $nbDevi = Devi::count('id_devi');
    $nbImpression = Impression::count('id_impression');
    $nbLivrer = Livrer::count('id_livrer');
    $users = User::where('users.id','=',Auth::id())->get();
        return view('designs.home',compact('users','nbDevi','nbImpression','nbLivrer'));
    }

    public function imprimeur(){
    $nbDevi = Devi::count('id_devi');
    $nbImpression = Impression::count('id_impression');
    $nbLivrer = Livrer::count('id_livrer');
    $users = User::where('users.id','=',Auth::id())->get();
        return view('imprimeurs.home',compact('users','nbDevi','nbImpression','nbLivrer'));
    }

    public function livreur(){
    $nbDevi = Devi::count('id_devi');
    $nbImpression = Impression::count('id_impression');
    $nbLivrer = Livrer::count('id_livrer');
    $users = User::where('users.id','=',Auth::id())->get();
        return view('livreurs.home',compact('users','nbDevi','nbImpression','nbLivrer'));
    }

    public function index(){
    	return view('welcome');
    }

    public function otpLogin(Request $request)
    {
        $otpLogin = AccountKit::accountKitData($request->code);
        dump($otpLogin);
    }
}
