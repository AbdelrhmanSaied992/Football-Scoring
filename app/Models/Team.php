<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Team extends Model
{
    use HasFactory;

    protected $table = 'teams';

    protected $fillable =
        [
            'name',
            'image',
            'team_administrative_id',
        ];

    protected $appends = ['image_url'];

    public function teamAdministrative(): BelongsTo
    {
        return $this->belongsTo(TeamAdministrative::class,'team_administrative_id');
    }

    public function joinedTournaments(): HasMany
    {
        return $this->hasMany(ParticipatingTeam::class,'team_id');
    }

    public function players(): HasMany
    {
        return $this->hasMany(Player::class,'team_id');
    }

    public function matchResults(): HasMany
    {
        return $this->hasMany(MatchResult::class,'team_id');
    }

    public function getImageUrlAttribute()
    {
        return url($this->image);
    }


}
