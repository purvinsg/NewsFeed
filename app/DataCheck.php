<?php

namespace App;

use App\Core\Session;

class DataCheck
{
    public static function article(string $title, string $content): bool
    {
        if (self::stringLength($title, 3, 255)) {
            Session::flash('errors', 'Title must be between 3 and 255 characters long');
        }

        if (self::stringLength($content, 10, 5000)) {
            Session::flash('errors', 'Article content must be between 10 and 5000 characters');
        }
        return Session::has('errors');
    }

    public static function comment(string $title, string $content): bool
    {
        if (self::stringLength($title, 5, 500)) {
            Session::flash('errors', 'Comment title must be between 5 and 500 characters');
        }

        if (self::stringLength($content, 5, 100)) {
            Session::flash('errors', 'Comment content must be between 5 and 100 characters');
        }

        return Session::has('errors');
    }

    public static function stringLength(string $string, int $min, int $max = PHP_INT_MAX): bool
    {
        $length = strlen(trim($string));
        return $length < $min || $length > $max;
    }

    public static function registrationForm(
        string $name,
        string $email,
        string $password,
        string $passwordConfirmation ): bool
    {
        if (self::stringLength($password, 8)) {
            Session::flash('errors', 'Password must be at least 8 characters long');
        }

        if ($password !== $passwordConfirmation) {
            Session::flash('errors', 'Passwords do not match');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            Session::flash('errors', 'Please enter a valid email address');
        }

        if (self::stringLength($name, 1, 100)) {
            Session::flash('errors', 'Please enter a valid name');
        }

        return Session::has('errors');
    }

}