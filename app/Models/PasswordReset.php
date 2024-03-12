<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PasswordReset extends Model
{
    use HasFactory;

    protected $table = 'password_resets';

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function games() : BelongsToMany
    {
        return $this
            ->belongsToMany(Game::class, 'user_games', 'user_id', 'game_id', 'id', 'id')
            ->using(UserGame::class)
            ->withTimestamps();
    }

    public function successes() : BelongsToMany
    {
        return $this
            ->belongsToMany(Success::class, 'success_users', 'user_id', 'success_id', 'id', 'id')
            ->using(SuccessUser::class)
            ->withTimestamps();
    }

    public function friends() : BelongsToMany
    {
        return $this
            ->belongsToMany(User::class, 'friends', 'user_id', 'friend_id', 'id', 'id')
            ->using(Friend::class)
            ->withTimestamps();
    }

    public function profileFields() : BelongsToMany
    {
        return $this
            ->belongsToMany(ProfileField::class, 'profile_field_users', 'user_id', 'profile_field_id', 'id', 'id')
            ->using(ProfileFieldUser::class)
            ->withTimestamps();
    }
}
