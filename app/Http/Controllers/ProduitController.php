<?php

namespace App\Http\Controllers;

use App\Commande;
use App\Produit;
use App\Panier;
use Auth;
use Illuminate\Http\Request;
use Session;
use App\Http\Requests;
use Stripe\Charge;
use Stripe\Stripe;

class ProduitController extends Controller
{
    public function getIndex()
    {
        //Session::flush();
        $produits = Produit::all();
        return view('shop.index')->withProduits($produits);
    }

    public function getAjouterAuPanier(Request $request,$id){
        //On trouve d'abord le produit que l'on veut add au panier
        $produit = Produit::find($id);
        //On check la session pour voir si il y a déjà un panier en cours
        $vieuxPanier = Session::has('panier') ? Session::get('panier') : null;
        //Creation OU mise à jour de $panier
        $panier = new Panier($vieuxPanier);
        //Ajout au panier du produit
        $panier->ajouter($produit, $produit->id);
        //mise à jour de la session panier
        $request->session()->put('panier', $panier);
        return redirect()->route('produit.index');
    }
    public function getPanier()
    {
        //Si pas de session panier alors on renvoie la vue panier
        if (!Session::has('panier')) {
            return view('shop.panier');
        }
        //Si Session panier
        $vieuxPanier = Session::get('panier');
        //On assigne le panier en cours à $panier
        $panier = new Panier($vieuxPanier);

        //On genere la vue avec les contenu du panier
        return view('shop.panier', ['produits' => $panier->produits, 'prixTotal' => $panier->prixTotal]);
    }
    public function getPaiement()
    {
        if (!Session::has('panier')) {
            return view('shop.panier');
        }
        $vieuxPanier = Session::get('panier');
        $panier = new Panier($vieuxPanier);
        $total = $panier->prixTotal;
        return view('shop.paiement', ['total' => $total]);
    }
    public function postPaiement(Request $request)
    {
        if (!Session::has('panier')) {
            return redirect()->route('shop.panier');
        }
        $vieuxPanier = Session::get('panier');
        $panier = new Panier($vieuxPanier);
        Stripe::setApiKey('sk_test_yY8KNLKjkhQoH1t96kTbVCzM');
        try {
            $charge = Charge::create(array(
                "amount" => $panier->prixTotal * 100,
                "currency" => "eur",
                "source" => $request->input('stripeToken'), // obtained with Stripe.js
                "description" => "Test Charge"
            ));
            $order = new Commande();
            $order->cart = serialize($panier);
            $order->address = $request->input('address');
            $order->name = $request->input('name');
            $order->payment_id = $charge->id;

            Auth::user()->commandes()->save($order);
        } catch (\Exception $e) {
            return redirect()->route('paiement')->with('error', $e->getMessage());
        }
        Session::forget('panier');
        return redirect()->route('produit.index')->with('success', 'Achat effectue avec succes!');
    }
    
    public function viderPanier(){
        Session::forget('panier');
        return redirect()->route('produit.index')->with('success', 'Panier vidé!');
    }
}
