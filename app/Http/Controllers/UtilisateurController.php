<?php
namespace App\Http\Controllers;
use App\Commande;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use Session;
use Jenssegers\Date\Date;

class UtilisateurController extends Controller
{
    public function __construct()
    {
        Date::setLocale('fr');
    }

    public function getInscription()
    {
        return view('utilisateur.inscription');
    }
    public function postInscription(Request $request)
    {
        $this->validate($request, [
            'email' => 'email|required|unique:users',
            'password' => 'required|min:4'
        ]);
        $utilisateur = new User([
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password'))
        ]);
        $utilisateur->save();
        //Avec la methode helper de la Facade auth on peut facilement logger un ussr
        Auth::login($utilisateur);
        //et le rediriger la ou il était avant
        if (Session::has('oldUrl')) {
            $oldUrl = Session::get('oldUrl');
            Session::forget('oldUrl');
            return redirect()->to($oldUrl);
        }
        return redirect()->route('utilisateur.profil');
    }
    public function getConnexion()
    {
        return view('utilisateur.connexion');
    }
    public function postConnexion(Request $request)
    {
        $this->validate($request, [
            'email' => 'email|required',
            'password' => 'required|min:4'
        ]);
        //On utilise la FACADE Auth pour authentifier les users
        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            if (Session::has('oldUrl')) {
                $oldUrl = Session::get('oldUrl');
                Session::forget('oldUrl');
                return redirect()->to($oldUrl);
            }
            return redirect()->route('utilisateur.profil');
        }
        return redirect()->back();
    }
    public function getProfil() {
        $commandes = Auth::user()->commandes;
        //la methode transform va loop sur l'obt qui est sous forme de string en BDD
        $commandes->transform(function($order, $key) {
            $order->cart = unserialize($order->cart);
            return $order;
        });
        return view('utilisateur.profil', ['commandes' => $commandes]);
    }

    public function getDeconnexion() {
        Auth::logout();
        return redirect()->route('utilisateur.connexion');
    }
}