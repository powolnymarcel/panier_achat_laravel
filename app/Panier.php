<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Panier extends Model
{
    public $produits = null;
    public $quantiteTotal = 0;
    public $prixTotal = 0;
    
    public function __construct($vieuxPanier)
    {
        //Si il y avait déjà un panier en cours on set les variables
        if ($vieuxPanier) {
            $this->produits = $vieuxPanier->produits;
            $this->quantiteTotal = $vieuxPanier->quantiteTotal;
            $this->prixTotal = $vieuxPanier->prixTotal;
        }
    }
    //Ensuite on ajoute
    public function ajouter($produit, $id) {
        $produitPretPourAjout = ['qty' => 0, 'prix' => $produit->price, 'produit' => $produit];

        //Si il y a un groupe de produits
        if ($this->produits) {
            //Si le produit se trouve dans le groupe de produits
            if (array_key_exists($id, $this->produits)) {
                //Si il est dans le groupe on le selectionne.
                $produitPretPourAjout = $this->produits[$id];
            }
        }
        //On augmente sa quantité, si c'est un nouveau produit entrant dans le groupe alors sa quantité sera de "1" si il était déjà présente alors sa quantité sera de "n +1"
        $produitPretPourAjout['qty']++;
        //Le prix de ce produit sera multiplié par sa quantité
        $produitPretPourAjout['prix'] = $produit->price * $produitPretPourAjout['qty'];

        //Creation du produit dans l'array produitS
        $this->produits[$id] = $produitPretPourAjout;
        //Augmentation de la quantité du panier
        $this->quantiteTotal++;
        //Le prix total sera augmenté du prix du produit en cours d'ajout
        $this->prixTotal += $produit->price;
    }
}
