<?php

namespace App\Broadcasting;

use App\Models\Game;
use App\Models\User;

class GameChannel
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
    public function join(User $user, string $gameSlug): array|bool
    {
        return ['id' => $user->id, 'pseudo' => $user->pseudo];
    }
}
