<?php

function message(string $message, string $type): string
{
    return utf8_encode("<div class=\"alert alert-{$type}\">{$message}</div>");
}

function flash(string $type = null, string $message = null): ?string
{
    if ($type && $message) {
        $_SESSION['FLASH'] = [
            "type" => $type,
            "message" => $message
        ];

        return null;
    }

    if (! empty($_SESSION['FLASH'])) {
        $flash = $_SESSION['FLASH'];
        unset($_SESSION['FLASH']);

        return message($flash['message'], $flash['type']);
    }

    return null;
}

function currencyFormatter(string $currency, bool $full = true): string
{
    $currency = number_format($currency, 2, ",", ".");

    if ($full) {
        $currency = "R$ " . $currency;
    }
    return $currency;
}
