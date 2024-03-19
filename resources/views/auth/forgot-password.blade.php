<html>
<head>
    <title>Register</title>
</head>
<body>
<div>
    <h1>Forgor Password</h1>
    <a href="{{route('home')}}">Home</a>
    <div>
        <form action="{{route('password.forgot.post')}}" method="POST">
            @csrf
            <x-input label="Email" name="email" type="email"></x-input>

            <input type="submit" value="Envoyer">
        </form>
    </div>
</div>
</body>
</html>
