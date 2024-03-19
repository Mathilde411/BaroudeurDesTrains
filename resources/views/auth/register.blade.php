<html>
<head>
    <title>Register</title>
</head>
<body>
<div>
    <h1>Register</h1>
    <a href="{{route('home')}}">Home</a>
    <div>
        <form action="{{route('register.post')}}" method="POST">
            @csrf
            <x-input label="Pseudo" name="pseudo" type="text"></x-input>
            <x-input label="Email" name="email" type="email"></x-input>
            <x-input label="Password" name="password" type="password"></x-input>
            <x-input label="Confirmation" name="password_confirmation" type="password"></x-input>

            <input type="submit" value="S'inscrire">
        </form>
    </div>
    <a href="{{route('register')}}">Se connecter</a>
</div>
</body>
</html>
