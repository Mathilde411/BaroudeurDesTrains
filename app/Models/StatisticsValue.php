<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StatisticsValue extends Model
{
    use HasFactory;

    protected $table = 'statistics_values';

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function game() : BelongsTo
    {
        return $this->belongsTo(Game::class);
    }

    public function statistics() : BelongsTo
    {
        return $this->belongsTo(Statistics::class, 'statistics_id');
    }
}
