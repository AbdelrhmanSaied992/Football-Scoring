<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tournament extends Model
{
    use HasFactory;

    protected $table = 'tournaments';

    protected $fillable =
        [
            'name',
            'logo',
            'format',
        ];

    protected $appends = ['image_url'];

    public function joinedTeams(): HasMany
    {
        return $this->hasMany(ParticipatingTeam::class,'tournament_id');
    }
    public function tournamentMatches(): HasMany
    {
        return $this->hasMany(MatchScheduling::class,'tournament_id');
    }
    public function getImageUrlAttribute()
    {
        return url($this->image);
    }



}
