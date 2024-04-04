<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
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
        $game->save();

        return redirect()->route('game', ['game:slug' => $game->slug]);
    }

    public function game(Game $game) {

    }

    public function games() {


    }
}
