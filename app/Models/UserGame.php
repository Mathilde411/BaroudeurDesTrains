<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UserGame extends Pivot
{
    protected $table = 'user_games';
    protected $primaryKey = ['game_id', 'user_id'];
    public $timestamps = true;
}
