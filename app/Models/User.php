<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function tokens() : HasMany
    {
        return $this->hasMany(Token::class);
    }

    public function createdGames() : HasMany
    {
        return $this->hasMany(Game::class);
    }

    public function statisticsValues() : HasMany
    {
        return $this->hasMany(StatisticsValue::class);
    }

    public function conversation() : BelongsToMany
    {
        return $this->belongsToMany(Conversation::class, 'conversation_users')
            ->using(ConversationUser::class)
            ->withTimestamps();
    }

    public function profileFields() : BelongsToMany {
        return $this
            ->belongsToMany(ProfileField::class, 'profile_field_users', 'user_id', 'profile_field_id', 'id', 'id')
            ->using(ProfileFieldUser::class)
            ->withPivot('value', 'created_at', 'updated_at')
            ->withTimestamps();
    }

    public function getFields()
    {
        $fields = [];

        foreach ($this->profileFields as $rawField) {
            $fields[$rawField->name] = $rawField->pivot->value;
        }

        return $fields;
    }

}
