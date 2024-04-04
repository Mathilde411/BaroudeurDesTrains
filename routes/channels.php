<?php

use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('game.{gameSlug}', \App\Broadcasting\GameChannel::class);
Broadcast::channel('game.{gameSlug}.{userId}', \App\Broadcasting\PlayerChannel::class);

