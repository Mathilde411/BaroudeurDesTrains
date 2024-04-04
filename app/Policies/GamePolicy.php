<?php

namespace App\Policies;

use App\Models\Game;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class GamePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function start(User $user, Game $game)
    {
        return $user->id === $game->user_id
            ? Response::allow()
            : Response::deny('Vous n\'êtes pas le créateur de cette partie.');
    }
}
