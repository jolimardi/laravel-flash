<?php

namespace JoliMardi\Flash;


use JoliMardi\Flash\FlashService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Foundation\Application;

class FlashServiceProvider extends ServiceProvider {
    public function boot() {
        $this->loadViewsFrom(__DIR__ . '/views', 'Flash');

        // Vu qu'on utilise la classe en Static uniquement, je suis pas sur que ça serve...
        // C'est pour enregistrer toujours la même instance de la classe : https://laravel.com/docs/10.x/container#binding-a-singleton
        $this->app->singleton('Flash', function (Application $app) {
            return new FlashService;
        });
    }
    public function register() {
    }
}
