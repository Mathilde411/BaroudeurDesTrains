<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Game extends Model
{
    use HasFactory;

    protected $table = 'games';

    public function gameState() : BelongsTo
    {
        return $this->belongsTo(GameState::class, 'game_state_id', 'id');
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function staticticsValues() : HasMany
    {
        return $this->hasMany(StatisticsValue::class, 'game_id', 'id');
    }

    public function players() : BelongsToMany
    {
        return $this
                ->belongsToMany(User::class, 'user_games', 'game_id', 'user_id', 'id', 'id')
                ->using(UserGame::class)
                ->withTimestamps();
    }
}
