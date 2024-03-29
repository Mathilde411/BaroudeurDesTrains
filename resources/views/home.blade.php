@extends('templates.main')

@section('title', 'Accueil')

@section('content')
    <h1>Home</h1>
    @guest
        <p>Vous n'êtes pas connecté</p>
        <a href="{{route('login')}}">Login</a>
        <a href="{{route('register')}}">Register</a>
        <a href="{{route('password.forgot')}}">Forgot Password</a>
    @endguest
    @auth
        <p>Bienvenue {{Auth::user()->pseudo}} !</p>
        <a href="{{route('logout')}}">Logout</a>
        <a href="{{route('conversation', ['conversation' => 1])}}">Chat</a>
        <x-map></x-map>
        <div id="orleans_nice" class="destination">orleans_nice</div>
        <div id="limoges_milan" class="destination">limoges_milan</div>
        <div id="barcelone_nice" class="destination">barcelone_nice</div>
    @endauth
@endsection
