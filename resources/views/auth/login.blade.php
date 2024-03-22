@extends('templates.main')

@section('title', 'Login')

@section('content')
    <h1>Login</h1>
    <div>
        <x-login-form></x-login-form>
    </div>
    <a href="{{route('register')}}">S'inscrire</a>
    <a href="{{route('password.forgot')}}">Mot de passe oublié</a>
@endsection
