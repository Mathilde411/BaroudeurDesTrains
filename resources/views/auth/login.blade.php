@extends('templates.main')

@section('title', 'Login')

@section('content')
    <h1>Login</h1>
    <a href="{{route('home')}}">Home</a>
    <div>
        <x-form-login></x-form-login>
    </div>
    <a href="{{route('register')}}">S'inscrire</a>
    <a href="{{route('password.forgot')}}">Mot de passe oublié</a>
@endsection
