<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class TeamAdministrative extends Authenticatable
{
    use HasApiTokens, HasFactory;

    protected $table = 'team_administrators';

    protected $fillable =
        [
            'name',
            'email',
        ];
    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    public function team(): HasOne
    {
        return $this->hasOne(Team::class,'team_administrative_id');
    }

    public function players(): HasMany
    {
        return $this->hasMany(Player::class,'team_id');
    }

}
