<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Contracts\PiecesOfAdvicesRepositoryInterface;
use App\Repositories\PiecesOfAdvicesRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(PiecesOfAdvicesRepositoryInterface::class, PiecesOfAdvicesRepository::class);
    }
}
