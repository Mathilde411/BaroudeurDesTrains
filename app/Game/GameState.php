<?php

namespace App\Game;

use App\Models\Game;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Vite;

class GameState
{

    private Game $game;
    private array $playerStates = [];
    private $board;

    public function __construct(Game $game)
    {
        $this->game = $game;
        $players = $game->players;

        $colors = ['red', 'blue', 'green', 'yellow'];
        $i = 0;
        foreach ($players as $player) {
            $this->playerStates[] = new PlayerState($player, $colors[$i]);
            $i++;
        }

        $this->board = json_decode(file_get_contents(resource_path('/json/coordinates.json')));
    }


    public function __serialize(): array
    {
        return [
            'game' => $this->game->id,
            'playerStates' => $this->playerStates
        ];
    }

    public function __unserialize(array $data): void
    {
        $this->game = Game::find($data['game']);
        $this->playerStates = $data['playerStates'];
        $this->board = json_decode(file_get_contents(resource_path('/json/coordinates.json')));
    }
}
