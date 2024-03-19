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
        <img class="logo" src="#" alt="Logo"/>
        <nav>
            <ul>
                <li><a href="#">Lien</a></li>
                <li><a href="#">Lien</a></li>
                <li><a href="#">Lien</a></li>
            </ul>
        </nav>
        <div class="profile">
            @guest

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
