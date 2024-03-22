@php use Illuminate\Support\Facades\Vite; @endphp
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Baroudeur des Trains - @yield('title')</title>

    <meta charset="UTF-8">

    @vite('resources/css/app.scss')
    @stack('style')

    @vite('resources/js/app.js')
    @stack('scripts')
</head>
<body>
<header>
    <img class="logo" src="{{Vite::asset('resources/images/logo.png')}}" alt="Logo"/>
    <nav>
        <ul>
            <li><a href="{{route('conversation', ['conversation' => 1])}}">Chat</a></li>
            <li><a href="#">Lien</a></li>
            <li><a href="#">Lien</a></li>
        </ul>
    </nav>
    <div class="profile">
        @guest
            <a class="btn btn-main" href="#">S'inscrire</a> ou <a href="#">Se connecter</a>
        @endguest
        @auth

        @endauth
    </div>
</header>
<div id="content">
    @yield('content')
</div>
<footer>

</footer>
</body>
</html>
