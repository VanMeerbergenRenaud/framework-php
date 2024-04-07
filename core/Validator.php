<?php

namespace Core;

use Core\Exceptions\RuleNotFoundException;

class Validator
{
    public static function check(array $constraints): array
    {
        $_SESSION['errors'] = [];
        $_SESSION['old'] = [];

        $request_data = array_filter(
            $_POST,
            fn(string $k) => $k !== '_method' && $k !== '_csrf',
            ARRAY_FILTER_USE_KEY
        );

        try {
            self::parse_constraints($constraints);
        } catch (RuleNotFoundException $e) {
            Response::abort(Response::SERVER_ERROR);
        }

        if (count($_SESSION['errors']) > 0) {
            $_SESSION['old'] = $request_data;
            Response::redirect($_SERVER['HTTP_REFERER']);
        }

        return $request_data;
    }

    private static function parse_constraints(array $constraints): void
    {
        $method = '';
        $value = null;

        foreach ($constraints as $key => $rules) {
            $rules = explode('|', $rules);

            foreach ($rules as $rule) {
                if (str_contains($rule, ':')) {
                    $rule_arr = explode(':', $rule);
                    [$method, $value] = $rule_arr;
                } else {
                    $method = $rule;
                }

                if (!method_exists(self::class, $method)) {
                    throw new RuleNotFoundException("La règle {$method} n'existe pas");
                }

                self::$method($key, $value);
            }
        }
    }

    // Vérifier si la valeur est un entier
    private static function integer(string $key): bool
    {
        if (!filter_var($_POST[$key], FILTER_VALIDATE_INT)) {
            $_SESSION['errors'][$key] = "Le champ {$key} doit être un entier";
            return false;
        }

        return true;
    }

    private static function required(string $key): bool
    {
        if (empty($_POST[$key])) {
            $_SESSION['errors'][$key] = "Le champ {$key} est requis";
            return false;
        }

        return true;
    }

    private static function min(string $key, int $value): bool
    {
        if (mb_strlen($_POST[$key]) < $value) {
            $_SESSION['errors'][$key] = "La taille de {$key} doit être supérieure à {$value}";
            return false;
        }

        return true;
    }

    private static function max(string $key, int $value): bool
    {
        if (mb_strlen($_POST[$key]) > $value) {
            $_SESSION['errors'][$key] = "La taille de {$key} doit être inférieure à {$value}";
            return false;
        }

        return true;
    }

    private static function datetime(string $key): bool
    {
        if(!date_create_from_format('Y-m-d H:i:s', $_POST[$key])) {
            $_SESSION['errors'][$key] = 'La date de début doit être au format AAAA-MM-JJ HH:MM:SS';
            return false;
        }

        return true;
    }
}