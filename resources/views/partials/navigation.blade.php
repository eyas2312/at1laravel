<nav class="navigation">

    <a href="{{ route('accueil') }}">MediaHub</a>

    <a href="{{ route('contenus.index') }}">Contenus</a>

    <a href="{{ route('a-propos') }}">À propos</a>

    @guest
        <a href="{{ route('inscription') }}">S'inscrire</a>
        <a href="{{ route('connexion') }}">Se connecter</a>
    @endguest

    @auth
    @if (auth()->check())
        <span>Bonjour, {{ auth()->user()->name }}</span>
    @else
        <span>Utilisateur non connecté</span>
    @endif        <form action="{{ route('deconnexion') }}" method="POST">
            @csrf
            <button type="submit">Déconnexion</button>
        </form>
    @endauth

</nav>