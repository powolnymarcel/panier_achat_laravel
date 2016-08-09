@extends('layouts.master')

@section('title')
 Panier d'achat Laravel
@endsection

@section('content')
    <!--permet de diviser en paquet de 3 tous les item-->
    @foreach($produits->chunk(3) as $productChunk)
        <div class="row">
            <!--permet looper parmis tous les paquets et afficher les produits-->
        @foreach($productChunk as $product)
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <img src="{{ $product->imagePath }}" alt="..." class="img-responsive">
                        <div class="caption">
                            <h3>{{ $product->title }}</h3>
                            <p class="description">{{ $product->description }}</p>
                            <div class="clearfix">
                                <div class="pull-left price">€{{ $product->price }}</div>
                                <a href="{{ route('produit.ajouterAuPanier', ['id' => $product->id]) }}"
                                   class="btn btn-success pull-right" role="button">Ajouter au panier</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
@endsection