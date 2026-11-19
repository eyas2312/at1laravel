@extends('layouts.app')

@section('contenu')
    <h1>Créer un compte</h1>

    <form method="POST" action="{{ route('inscription.enregistrer') }}">
        @csrf

        <label>Nom</label>
        <input type="text" name="name" value="{{ old('name') }}" required>
        @error('name') <p>{{ $message }}</p> @enderror
<br>
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required>
        @error('email') <p>{{ $message }}</p> @enderror

       <br> <label>Mot de passe</label>
        <input type="password" name="password" required>

       <br> <label>Confirmer le mot de passe</label>
        <input type="password" name="password_confirmation" required>
        @error('password') <p>{{ $message }}</p> @enderror

     <br>   <button type="submit">S'inscrire</button>
    </form>

    <p>Déjà un compte ? <a href="{{ route('connexion') }}">Se connecter</a></p>
@endsection