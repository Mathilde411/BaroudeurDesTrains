<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProfileFieldUser extends Pivot
{
    protected $table = 'profile_field_users';
    protected $primaryKey = ['profile_field_id', 'user_id'];
    public $timestamps = true;
}
