@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <h1>Connexion</h1>
            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            <form action="{{ route('utilisateur.connexion') }}" method="post">
                <div class="form-group">
                    <label for="email">E-Mail</label>
                    <input type="text" id="email" name="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Connexion</button>
                {{ csrf_field() }}
            </form>
            <p>Pas de compte ? <a href="{{ route('utilisateur.inscription') }}">Inscrivez-vous ici !</a></p>
            <a class="btn btn-link" href="{{ url('/password/reset') }}">Mot de passe oublié ?</a>

        </div>
    </div>
@endsection