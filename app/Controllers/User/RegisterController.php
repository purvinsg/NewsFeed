<?php

namespace App\Controllers\User;

use App\DataCheck;
use App\Core\Redirect;
use App\Core\Session;
use App\Core\View;
use App\Services\User\Create\CreateUserRequest;
use App\Services\User\Create\CreateUserService;



class RegisterController
{
    private CreateUserService $createUserService;

    public function __construct(

        CreateUserService $createUserService
    )
    {
        $this->createUserService = $createUserService;
    }

    public function register(): View
    {
        return new View('user/register', []);
    }

    public function store(): Redirect
    {
        $email = $_POST['email'];
        $name = $_POST['name'];
        $password = $_POST['password'];
        $passwordConfirmation = $_POST['password_confirmation'];

        if (DataCheck::registrationForm($name, $email, $password, $passwordConfirmation)) {
            Session::flash('email', $email);
            return new Redirect('/register');
        }

        $user = $this->createUserService->execute(new CreateUserRequest($email, $name, $password, $passwordConfirmation));

        if (!$user) {
            Session::flash('errors', 'User creation failed');
            Session::flash('email', $email);
            return new Redirect('/register');
        }

        Session::put('user', $user);
        return new Redirect('/');
    }



}

