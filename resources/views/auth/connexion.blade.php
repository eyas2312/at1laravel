@extends('layouts.app')

@section('contenu')
    <h1>Se connecter</h1>

    <form method="POST" action="{{ route('connexion.authentifier') }}">
        @csrf

        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required>
        @error('email') <p>{{ $message }}</p> @enderror

        <br><label>Mot de passe</label>
        <input type="password" name="password" required>

        <br><button type="submit">Se connecter</button>
    </form>

    <p>Pas encore de compte ? <a href="{{ route('inscription') }}">S'inscrire</a></p>
@endsection