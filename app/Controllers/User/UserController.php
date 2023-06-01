<?php

namespace App\Controllers\User;


use App\Core\View;
use App\Exceptions\RecourseNotFoundException;
use App\Services\User\IndexUserService;
use App\Services\User\Show\ShowUserRequest;
use App\Services\User\Show\ShowUserResponse;
use App\Services\User\Show\ShowUserService;


class UserController
{
    private IndexUserService $indexUserService;
    private ShowUserService $showUserService;

    public function __construct(
        IndexUserService  $indexUserService,
        ShowUserService   $showUserService,
    )
    {
        $this->indexUserService = $indexUserService;
        $this->showUserService = $showUserService;
    }

    public function index(): View
    {
        $service = $this->indexUserService;
        $users = $service->execute();
        return new View('user/index', ['users' => $users]);
    }

    public function show(array $vars): View
    {
        try {
            $userId = $vars['id'];
            $service = $this->showUserService;
            $request = $service->execute(new ShowUserRequest((int)$userId));
            $response = new ShowUserResponse($request->getUser(), $request->getArticles());
            return new View('user/show',
                [
                    'user' => $response->getUser(),
                    'articles' => $response->getArticles()
                ]);
        } catch (RecourseNotFoundException $exception) {
            return new View('notFound', []);
        }
    }
}

