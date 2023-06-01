<?php declare(strict_types=1);

namespace App\Services\User\Create;

use App\Repositories\User\UserRepository;
use App\Core\Session;
use App\Models\User;


class CreateUserService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(CreateUserRequest $request): ?User
    {
        $user = new User(
            $request->getEmail(),
            $request->getPassword(),
            $request->getName()
        );

        if($this->userRepository->authenticate($user)){
            Session::flash('errors', 'User with this email already exists');
            return null;
        };

        $this->userRepository->store($user);
        return $user;
    }

}