<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ParticipatingTeam extends Model
{
    use HasFactory;

    protected $table = 'participating_teams';
    protected $fillable =
        [
            'team_id',
            'tournament_id',
            'result',
        ];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class,'team_id');
    }

    public function tournament(): BelongsTo
    {
        return $this->belongsTo(Tournament::class,'tournament_id');
    }

}
