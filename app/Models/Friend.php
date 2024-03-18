<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Friend extends Pivot
{
    protected $table = 'friends';
    protected $primaryKey = ['friend_id', 'user_id'];
    public $timestamps = true;


}
