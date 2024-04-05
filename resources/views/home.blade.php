@extends('templates.main')

@section('title', 'Accueil')

@section('content')
    <h1>Accueil</h1>
    @guest
        <p>Vous n'êtes pas connecté</p>
    @endguest
    @auth
        <p>Bienvenue {{Auth::user()->pseudo}} !</p>
    @endauth
@endsection
