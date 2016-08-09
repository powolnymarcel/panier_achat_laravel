<?php

namespace App\Http\Controllers;

use App\Produit;
use Illuminate\Http\Request;

use App\Http\Requests;

class ProduitController extends Controller
{
    public function getIndex()
    {
        $produits = Produit::all();
        return view('shop.index')->withProduits($produits);
    }
}
