@extends('templates.main')

@section('title', 'Parties')

@section('content')
    <h1>Games</h1>

    <table>
        <thead>
        <tr>
            <th>Nom</th>
            <th>Créateur</th>
            <th>Joueurs</th>
            <th>Lien</th>
        </tr>
        </thead>
        <tbody>
        @foreach($games as $game)
            <tr>
                <td>{{$game->name}}</td>
                <td>{{$game->user->pseudo}}</td>
                <td>??/??</td>
                <td><a href="{{route('game', ['game' => $game])}}">Rejoindre</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <h1>Créer</h1>
    <form action="{{route('game.create')}}" method="POST">
        @csrf
        <x-input label="Nom" name="name" type="text"></x-input>
        <x-checkbox label="Privé" name="private"></x-checkbox>
        <div class="end-btn">
            <input type="submit" value="Créer" class="btn main">
        </div>
    </form>
@endsection

@pushonce('style')
    @vite('resources/css/form.scss')
@endpushonce
