<?php

namespace JoliMardi\Flash;

use Illuminate\Support\Facades\Facade;

// Ca sert à quelque chose ce fichier ?
class Flash extends Facade {
    protected static function getFacadeAccessor() {
        return 'Flash';
    }
}
