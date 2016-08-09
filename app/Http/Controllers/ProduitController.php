<?php

namespace App\Http\Controllers;

use App\Produit;
use App\Panier;
use Illuminate\Http\Request;
use Session;
use App\Http\Requests;

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
}
