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
                            @foreach($commande->panier->items as $item)
                                <li class="list-group-item">
                                    <span class="badge">${{ $item['price'] }}</span>
                                    {{ $item['item']['title'] }} | {{ $item['qty'] }} Unités
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="panel-footer">
                        <strong>Total: ${{ $commande->panier->totalPrice }}</strong>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection