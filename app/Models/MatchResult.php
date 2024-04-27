<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MatchResult extends Model
{
    use HasFactory;

    protected $table = 'match_results';


    protected $appends = ['team'];

    protected $fillable =
        [
            'team_id',
            'match_scheduling_id',
            'score',
        ];

    public function getTeamAttribute()
    {
        return Team::find($this->team_id);
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class,'team_id');
    }

    public function matchScheduling(): BelongsTo
    {
        return $this->belongsTo(MatchScheduling::class,'match_scheduling_id');
    }

}
