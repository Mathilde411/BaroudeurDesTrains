<html>
<head>
    <title>Reset Password</title>
</head>
<body>
<div>
    <h1>Reset Password</h1>
    <div>
        <form action="{{route('password.reset.post')}}" method="POST">
            @csrf

            <input type="hidden" name="token" value="{{$token}}">
            <input type="hidden" name="email" value="{{$email}}">

            <x-input label="Password" name="password" type="password"></x-input>
            <x-input label="Confirmation" name="password_confirmation" type="password"></x-input>

            <input type="submit" value="Reset">
        </form>
    </div>
</div>
</body>
</html>
