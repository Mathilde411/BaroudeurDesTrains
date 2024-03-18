<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ConversationUser extends Pivot
{
    protected $table = 'conversation_users';
    protected $primaryKey = ['friend_id', 'user_id'];
    public $timestamps = true;
}
