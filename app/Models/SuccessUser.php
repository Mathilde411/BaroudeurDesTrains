<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class SuccessUser extends Pivot
{
    protected $table = 'success_users';
    protected $primaryKey = ['success_id', 'user_id'];
    public $timestamps = true;
}
