<?php

namespace App\Http\Controllers;

use App\Events\GameStartedEvent;
use App\Game\GameState;
use App\Models\Game;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Str;

class GameController extends Controller
{
    public function createGame(Request $request) {
        $req = $request->validate([
            'name' => ['required', 'string'],
            'private' => ['required', 'boolean']
        ]);

        $game = new Game();
        $game->name = $req['name'];
        $game->private = boolval($req['private']);
        $game->slug = Str::random();
        $game->game_state_id = 1;
        $game->user_id = Auth::user()->id;
        $game->save();

        return redirect()->route('game', ['game' => $game]);
    }

    public function game(Game $game) {
        return match ($game->game_state_id) {
            1 => view('game.lobby', ['game' => $game]),
            2 => view('game.game', ['game' => $game]),
            default => redirect()->route('home'),
        };
    }

    public function games() {
        return view('game.games', ['games' => Game::publicLobbies()]);
    }

    public function startGame(Game $game)
    {
        if($game->game_state_id !== 1)
            abort(404);

        $userIds = Broadcast::connection()->getPusher()->getPresenceUsers('presence-game.' . $game->slug)->users;
        $players = 0;
        foreach($userIds as $userId) {
            if(($user = User::find($userId->id)) != null) {
                $game->players()->attach($user);
            }

            $players++;
            if($players >= 4)
                break;
        }

        $game->game_state_id = 2;
        $game->save();

        GameStartedEvent::dispatch($game);

        return response()->noContent();
    }
}
