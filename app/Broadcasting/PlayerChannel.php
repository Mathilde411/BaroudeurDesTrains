<?php

namespace App\Broadcasting;

use App\Models\Game;
use App\Models\User;

class PlayerChannel
{
    /**
     * Create a new channel instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Authenticate the user's access to the channel.
     */
    public function join(User $user, string $gameSlug, int $userId): array|bool
    {
        $game = Game::where('slug', $gameSlug)->first();
        return ($game->players()->where('users.id', $userId)->exists()) && ($user->id == $userId);
    }
}
