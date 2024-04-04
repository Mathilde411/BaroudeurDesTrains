@extends('templates.main')

@section('title', 'Parties')

@section('content')
    <h1>Joueurs</h1>

    <table>
        <thead>
        <tr>
            <th>Pseudo</th>
        </tr>
        </thead>
        <tbody id="players">
        </tbody>
    </table>
    @if(Auth::user()->is($game->user))
        <button id="startGame" class="btn main">Démarrer</button>
    @endif
@endsection

@pushonce('scripts')
    <script>
        window.game = {
            slug: '{{$game->slug}}',
            startRoute: '{{route('game.start', ['game' => $game])}}'
        }
    </script>
    @vite('resources/js/lobby.js')
@endpushonce
