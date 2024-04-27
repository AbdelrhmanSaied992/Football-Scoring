<?php

namespace App\Providers;

use App\Repositories\Match\MatchInterface;
use App\Repositories\Match\MatchRepository;
use App\Repositories\Team\TeamInterface;
use App\Repositories\Team\TeamRepository;
use App\Repositories\Tournament\TournamentInterface;
use App\Repositories\Tournament\TournamentRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(TeamInterface::class, TeamRepository::class);
        $this->app->bind(TournamentInterface::class, TournamentRepository::class);
        $this->app->bind(MatchInterface::class, MatchRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
