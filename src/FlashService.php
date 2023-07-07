<?php

namespace JoliMardi\Flash;

use Illuminate\Support\Facades\Session;

class FlashService {

    // Romain : Attention, tu dois pas renvoyer les messages ici, juste $session ! (qui représente le "moteur" utilisé pour les messages) -> Il va falloir rework les fonctions qui s'en servent... C'est la fonction getMessages() qui renvoie les messages
    protected static function getSessionService(): array {
        return Session::get('_messages') ? Session::get('_messages') : [];
    }

    public static function getMessages(string $type = null, bool $remove = true): array {
        $session = self::getSessionService();
        $messages = $type ? $session[$type] : $session;

        if ($remove) {
            self::clear($type);
        }

        return $messages;
    }

    // Ici, peut-être faire un check supplémentaire quand $type = null : si jamais on a un tableau avec $messages['error] = [] par exemple (pas de message dans un "sous-type")
    public static function has(string $type = null): bool {
        $session = self::getSessionService();

        // si un $type est défini alors on cherche s'il y a des messages de ce type
        if ($type) {
            return isset($session[$type]) && !empty($session[$type]);
        } else {
            return !empty($session);
        }

        // Check s'il y a des messages dans la session en général
        foreach ($session as $messages) {
            if (!empty($messages)) {
                return $session;
            }
        }
    }

    public static function message(string $type, string $message): void {
        $session = self::getSessionService();
        $session[$type][] = $message;
        session()->flash('_messages', $session); // Je crois que c'est mieux d'utiliser flash() ici, https://laravel.com/docs/10.x/session#flash-data
    }

    public static function error(string $message): void {
        self::message('error', $message);
    }

    public static function notice(string $message): void {
        self::message('notice', $message);
    }

    public static function success(string $message): void {
        self::message('success', $message);
    }

    public static function clear(string $type = null): void {
        if ($type) {
            Session::forget("_messages.{$type}");
        } else {
            Session::forget('_messages');
        }
    }

    /* Pour les views dans output() et renderMessage(), il va falloir que tu mettes les views dans le package (cf https://laravel.com/docs/10.x/packages#views) */

    public static function output(bool $remove = true): string {
        $session = self::getSessionService();
        $output = '';

        if (!empty($session)) {
            foreach ($session as $type => $messages) {
                foreach ($messages as $message) {
                    $output .= self::renderMessage($type, $message);
                }
            }
        }

        if ($remove) {
            self::clear();
        }

        return $output;
    }

    protected static function renderMessage(string $type, string $message) {
        return view('Flash::output', compact('type', 'message'))->render();
    }
}
