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
            //die($e->getMessage());
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
        $value = null;
        $method = $rule = '';

        foreach ($constraints as $key => $rules) {
            /* rule1|rule2:arg|rule3:arg,arg2 */
            $param = null;
            $subparam = null;
            $rules = explode('|', $rules);
            foreach ($rules as $rule) {
                if (str_contains($rule, ':')) {
                    [$method, $param] = explode(':', $rule);
                    if (str_contains($param, ',')) {
                        [$param, $subparam] = explode(',', $param);
                    }
                } else {
                    $method = $rule;
                }
                if (!method_exists(self::class, $method)) {
                    throw new RuleNotFoundException($rule);
                }
                self::$method($key, $param, $subparam);
            }
        }
    }

    private static function email(string $key): bool
    {
        if (!filter_var($_REQUEST[$key], FILTER_VALIDATE_EMAIL)) {
            $_SESSION['errors'][$key] = 'La valeur fournie n’est pas une adresse email valide';

            return false;
        }

        return true;
    }

    private static function datetime(string $key): bool
    {
        if (!date_create_from_format('Y-m-d H:i', $_REQUEST[$key])) {
            $_SESSION['errors'][$key] = 'La date doit est une date au format AAAA-MM-JJ HH:MM';

            return false;
        }

        return true;
    }

    private static function max(string $key, int $value): bool
    {
        if (mb_strlen($_REQUEST[$key]) > $value) {
            $_SESSION['errors'][$key] = "{$key} doit avoir une taille maximum de {$value} caractères";

            return false;
        }

        return true;
    }

    private static function password(string $key): bool
    {
        if (!self::min($key, 8) || !self::numbers($key) || !self::special_chars($key)) {
            $_SESSION['errors'][$key] = "{$key} ne respecte pas le format demandé";

            return false;
        }

        return true;
    }

    private static function min(string $key, int $value): bool
    {
        if (mb_strlen($_REQUEST[$key]) < $value) {
            $_SESSION['errors'][$key] = "{$key} doit avoir une taille minimum de {$value} caractères";

            return false;
        }

        return true;
    }

    private static function numbers(string $key): bool
    {
        if (!preg_match('/\d+/', $_REQUEST[$key])) {
            $_SESSION['errors'][$key] = "{$key} doit contenir au moins un chiffre";

            return false;
        }

        return true;
    }

    private static function special_chars(string $key): bool
    {
        if (!preg_match('/[+\-*\/!?_]+/', $_REQUEST[$key])) {
            $_SESSION['errors'][$key] = "{$key} doit contenir au moins un caractère spécial";

            return false;
        }

        return true;
    }

    private static function required(string $key): bool
    {
        if (empty($_REQUEST[$key])) {
            $_SESSION['errors'][$key] = "{$key} doit obligatoirement être fourni";

            return false;
        }

        return true;
    }

    private static function exists(string $key, string $model, string $column = 'id'): bool
    {
        $model_name = 'App\\Models\\'.ucfirst($model);
        $model = new $model_name(base_path('.env.local.ini'));

        if ($column === 'id') {
            $method = 'find';
        } else {
            $column = ucfirst($column);
            $method = "findBy{$column}";
        }

        if (!method_exists($model, $method)) {
            return false;
        }

        if (!$model->$method($_REQUEST[$key])) {
            $_SESSION['errors'][$key] = "{$key} n'existe pas dans notre base de données";

            return false;
        }

        return true;
    }

    private static function doesntexists(string $key, string $model, string $column = 'id'): bool
    {
        $model_name = 'App\\Models\\'.ucfirst($model);
        $model = new $model_name(base_path('.env.local.ini'));

        if ($column === 'id') {
            $method = 'find';
        } else {
            $column = ucfirst($column);
            $method = "findBy{$column}";
        }

        if (!method_exists($model, $method)) {
            return false;
        }

        if (!($model->$method($_REQUEST[$key]))) {
            return true;
        }

        $_SESSION['errors'][$key] = "{$key} existe déjà dans notre base de données";

        return false;
    }
}
