<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
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
        return $this->belongsTo(GameState::class);
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function staticticsValues() : HasMany
    {
        return $this->hasMany(StatisticsValue::class);
    }

    public function players() : BelongsToMany
    {
        return $this
                ->belongsToMany(User::class, 'user_games')
                ->using(UserGame::class)
                ->withTimestamps();
    }

    public static function publicLobbies(): Collection
    {
        return static::where('game_state_id', 1)->where('private', 0)->get();
    }


}
