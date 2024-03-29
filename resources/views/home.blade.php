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
        <button id="rouen" class="hilight-city">Rouen</button>
        <button id="paris" class="hilight-city">Paris</button>
        <button id="clermont" class="hilight-city">clermont</button>
        <button id="londres" class="hilight-city">Londres</button>
        <button id="douai" class="hilight-city">Douai</button>
        <button id="bilbao" class="hilight-city">Bilbao</button>
    @endauth
@endsection
