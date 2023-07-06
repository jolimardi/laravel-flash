<?php

namespace JoliMardi\Flash;

use Illuminate\Support\Facades\Session;

class FlashService {

    protected static function getSessionService(): array {
        $session = session();
        $messages = $session->get('_messages', []);
        return $messages;
    }

    public static function getMessages(string $type = null, bool $remove = true): array {
        $session = self::getSessionService();
        $messages = $type ? $session[$type] : $session;

        if ($remove) {
            self::clear($type);
        }

        return $messages;
    }

    public static function has(string $type = null): bool {
        $session = self::getSessionService();
        return $type ? isset($session[$type]) : !empty($session);
    }

    public static function message(string $type, string $message): void {
        $session = self::getSessionService();
        $session[$type][] = $message;
        Session::put('_messages', $session);
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

    /*     public static function output(bool $remove = true): string {
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
        // Sans flash:: car il se trouve dans resources/view/components/output.blade.php
        return view('components.output', compact('type', 'message'));
    } */
}
