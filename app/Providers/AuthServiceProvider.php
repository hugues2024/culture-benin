<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
        // Gates pour l'accès aux modules (Admins et Managers)
        Gate::define('access-users', function ($user) {
            return $user->id_role === 4;
        }); 

        Gate::define('access-type-media', function ($user) {
            return $user->id_role === 4;
        });

        Gate::define('access-type-contenu', function ($user) {
            return $user->id_role === 4;
        });

        Gate::define('access-medias', function ($user) {
            return $user->id_role === 4;
        });

        Gate::define('access-contenu', function ($user) {
            return $user->id_role === 4;
        });

        Gate::define('access-langues', function ($user) {
            return $user->id_role === 4;
        });

        Gate::define('access-regions', function ($user) {
            return $user->id_role === 4;
        });

        Gate::define('access-commentaires', function ($user) {
            return $user->id_role === 4;
        });

        Gate::define('access-roles', function ($user) {
            return $user->id_role === 4; // Uniquement les admins
        });

        // Gates pour la suppression (UNIQUEMENT les admins)
        Gate::define('delete-users', function ($user) {
            return $user->id_role === 4;
        });

        Gate::define('delete-type-media', function ($user) {
            return $user->id_role === 4;
        });

        Gate::define('delete-type-contenu', function ($user) {
            return $user->id_role === 4;
        });

        Gate::define('delete-medias', function ($user) {
            return $user->id_role === 4;
        });

        Gate::define('delete-contenus', function ($user) {
            return $user->id_role === 4;
        });

        Gate::define('delete-langues', function ($user) {
            return $user->id_role === 4;
        });

        Gate::define('delete-regions', function ($user) {
            return $user->id_role === 4;
        });

        Gate::define('delete-commentaires', function ($user) {
            return $user->id_role === 4;
        });

        Gate::define('delete-roles', function ($user) {
            return $user->id_role === 4;
        });
    }
}
