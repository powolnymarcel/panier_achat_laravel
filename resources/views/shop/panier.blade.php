@extends('layouts.master')

@section('title')
    Panier d'achat Laravel
@endsection

@section('content')
    @if(Session::has('panier'))
        <div class="row">
            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                <ul class="list-group">
                    @foreach($produits as $produit)
                        <li class="list-group-item">
                            <span class="badge">{{ $produit['qty'] }}</span>
                            <strong>{{ $produit['produit']['title'] }}</strong>
                            <span class="label label-success">{{ $produit['prix'] }} €</span>
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary btn-xs dropdown-toogle" data-toggle="dropdown">Action <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Réduire de 1</a></li>
                                    <li><a href="#">Supprimer</a></li>
                                </ul>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                <strong>Total: {{ $prixTotal }}</strong>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                <a href="{{ route('paiement') }}" type="button" class="btn btn-success">Payer</a>
                <a href="{{ route('vider.panier') }}" type="button" class="btn btn-danger">Vider</a>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                <h2>Aucuns produits dans le panier!</h2>
            </div>
        </div>
    @endif
@endsection