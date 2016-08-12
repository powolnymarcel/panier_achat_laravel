@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>Profil utilisateur</h1>
            <p>{{Auth::user()->email}}</p>
            <p>Role: <strong>{{toStatus(Auth::user()->admin)}}</strong></p>
            <hr>
            <h2>Mes commandes</h2>
            
        @foreach($commandes as $commande)
                <div class="panel panel-default">
                    <div class="panel-body">
                        <ul class="list-group">
                            @foreach($commande->cart->produits as $item)
                                <li class="list-group-item">
                                    <span class="badge">€{{ $item['prix'] }}</span>
                                    Acheté le : <strong>{{ Date::parse($item['produit']['created_at'])->format('l j F Y H:i:s') }}</strong> <br /> | {{ $item['produit']['title'] }} | {{ $item['qty'] }} Unités
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="panel-footer">
                        <strong>Total: €{{ $commande->cart->prixTotal }}</strong>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection