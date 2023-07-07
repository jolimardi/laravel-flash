<?php

namespace JoliMardi\Flash;

use Illuminate\Support\Facades\Facade;

// Ca sert à quelque chose ce fichier ?
// https://laravel.com/docs/10.x/facades#how-facades-work
// Ce qui permet d'écrire Flash::has() au lieu de app('Flash')->has()
// Il existe d'autre facade : Route, DB, Cache... comme un centre commercial ou on choisit son magasin(sa classe), c'est comme sa que je le vois ^^'
class Flash extends Facade {
    protected static function getFacadeAccessor(): string {
        return 'Flash';
    }
}
