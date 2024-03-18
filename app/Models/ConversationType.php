<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConversationType extends Model
{
    use HasFactory;

    protected $table = 'conversation_types';
    public $timestamps = false;
}
