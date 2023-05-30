<?php

namespace App;

use App\Core\Session;

class DataCheck
{
    public static function article(string $title, string $content): bool
    {
        $errors = [];

        if (self::stringLength($title, 3, 255)) {
            $errors[] = 'Title must be between 3 and 255 characters long';
        }

        if (self::stringLength($content, 10, 5000)) {
            $errors[] = 'Article content must be between 10 and 5000 characters';
        }

        if (!empty($errors)) {
            Session::flash('errors', $errors);
        }

        return !empty($errors);
    }

    public static function registrationForm(string $name, string $email, string $password, string $passwordRepeat): bool
    {
        $errors = [];

        if (self::stringLength($password, 8, 250)) {
            $errors[] = 'Password must be at least 8 characters';
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Please enter a valid email address';
        }

        if ($password !== $passwordRepeat) {
            $errors[] = 'Passwords do not match';
        }
        if (self::stringLength($name, 1, 100)) {
            $errors[] = 'Please enter a valid name';
        }

        if (!empty($errors)) {
            Session::flash('errors', $errors);
        }

        return !empty($errors);
    }

    public static function comment(string $title, string $content): bool
    {
        $errors = [];

        if (self::stringLength($title, 3, 500)) {
            $errors[] = 'Comment title must be between 3 and 500 characters';
        }

        if (self::stringLength($content, 5, 100)) {
            $errors[] = 'Comment content must be between 5 and 100 characters';
        }

        if (!empty($errors)) {
            Session::flash('errors', $errors);
        }

        return !empty($errors);
    }

    private static function stringLength(string $string, int $min, int $max): bool
    {
        $length = strlen(trim($string));
        return $length < $min || $length > $max;
    }
}
