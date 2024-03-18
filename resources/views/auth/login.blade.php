<html>
<head>
    <title>Login</title>
</head>
<body>
<div>
    <h1>Login</h1>
    <a href="{{route('home')}}">Home</a>
    <div>
        <form action="{{route('login.post')}}" method="POST">
            @csrf
            <x-input label="Email" name="email" type="email"></x-input>
            <x-input label="Password" name="password" type="password"></x-input>
            <input type="hidden" name="remember" value="0">
            <x-input label="Rester connecté" name="remember" type="checkbox"></x-input>
            <input type="submit" value="Se connecter">
        </form>
    </div>
    <a href="{{route('register')}}">S'inscrire</a>
    <a href="{{route('password.forgot')}}">Mot de passe oublié</a>
</div>
</body>
</html>
