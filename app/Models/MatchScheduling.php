<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MatchScheduling extends Model
{
    use HasFactory;

    protected $table = 'match_scheduling';

    protected $fillable =
        [
            'date',
            'time',
            'venue',
            'status',
            'tournament_id',
        ];


    public function tournament(): BelongsTo
    {
        return $this->belongsTo(Tournament::class,'tournament_id');
    }
    public function matchResults(): HasMany
    {
        return $this->hasMany(MatchResult::class,'match_scheduling_id');
    }
    public function getTimeAttribute($value)
    {
        return Carbon::parse($this->date.' '.$value)->format('h:i A');
    }
}
