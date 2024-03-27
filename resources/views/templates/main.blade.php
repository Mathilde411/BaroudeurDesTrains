<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Baroudeur des Trains - @yield('title')</title>

    <meta charset="UTF-8">

    @vite('resources/css/app.scss')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    @stack('style')

    @vite('resources/js/app.js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>
    @stack('scripts')
</head>
<body>
<header>
    <a class="logo" href="{{route('home')}}">
        <img class="logo" src="{{Vite::asset('resources/images/logo.png')}}" alt="Logo"/>
    </a>

    <nav>
        <ul>
            <li><a href="#">Lien</a></li>
            @auth
            <li><a href="{{route('conversation', ['conversation' => 1])}}">Chat</a></li>
            <li><a href="#">Lien</a></li>
            @endauth
        </ul>
    </nav>
    <div @class(['profile', 'has-dropdown' => Auth::check()])class="profile">
        @guest
            <a class="btn main" href="{{route('register')}}">S'inscrire</a> ou <a href="{{route('login')}}">Se connecter</a>
        @endguest
        @auth
            <a class="drop" href="/profile/{{auth()->user()->id}}">
                <img class="profile-pic"
                     src="https://www.sayonneara.fr/wp-content/uploads/2019/03/blank-profile-picture-973460_1280.png">
            </a>
            <div class="dropdown">
                <a href="#">Paramètres<i class="fa-solid fa-gear"></i></a>
                <a href="#">Messages<i class="fa-solid fa-inbox"></i></a>
                <a href="{{route('logout')}}">Se déconnecter<i class="fa-solid fa-power-off"></i></a>
            </div>
        @endauth
    </div>
</header>
<div id="content">
    @yield('content')
</div>
<footer>
    <div class="footer-content">
        <p><a href="#">Conditions générales d'utilisation</a> | <a href="#">Confidentialité</a> | <a href="#">Mention légales</a></p>
        <p>Baroudeurs des Trains : un jeu fait en projet CDAW pendant 4 semaines.</p>
        <p>© 2024 - 2024</p>
    </div>
</footer>
</body>
</html>
