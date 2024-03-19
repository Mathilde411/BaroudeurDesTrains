<?php

namespace App\Models;

use App\Events\MessageReceivedEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Conversation extends Model
{
    use HasFactory;

    protected $table = 'conversations';

    public function users() : BelongsToMany
    {
        return $this->belongsToMany(User::class, 'conversation_users')
            ->withTimestamps()
            ->using(ConversationUser::class);
    }

    public function messages() : HasMany
    {
        return $this->hasMany(Message::class);
    }

    public function sendMessage(User $user, string $message)
    {
        $res = new Message();
        $res->message = $message;
        $res->conversation_id = $this->id;
        $res->user_id = $user->id;
        $res->save();

        MessageReceivedEvent::dispatch($res);

        return $res;
    }
}
