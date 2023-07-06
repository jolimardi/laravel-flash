<?php

namespace JoliMardi\Flash;


use Illuminate\Support\ServiceProvider;
use JoliMardi\Flash\FlashService;

class FlashServiceProvider extends ServiceProvider {
    public function boot() {
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');

        $this->app->singleton('Flash', function ($app) {
            return new FlashService;
        });
    }
    public function register() {
    }
}
