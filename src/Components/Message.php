<?php

namespace JoliMardi\Flash\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Message extends Component {
    public function __construct() {
    }

    public function render(): View|Closure|string {
        if (view()->exists('vendor.flash-messages.message')) {
            return view('vendor.flash-messages.message');
        }

        return view('Flash::message');
    }
}
