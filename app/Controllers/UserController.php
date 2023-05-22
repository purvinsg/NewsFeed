<?php declare(strict_types=1);

namespace App\Controllers;

require_once __DIR__ . '/../Core/View.php';
require_once __DIR__ . '/../Services/User/IndexUserService.php';
require_once __DIR__ . '/../Services/User/Show/ShowUserRequest.php';
require_once __DIR__ . '/../Services/User/Show/ShowUserService.php';
require_once __DIR__ . '/../Services/User/Show/ShowUserResponse.php';


use App\ApiClient;
use App\Core\View;
use App\Exceptions\RecourseNotFoundException;
use App\Services\User\IndexUserService;
use App\Services\User\Show\ShowUserRequest;
use App\Services\User\Show\ShowUserResponse;
use App\Services\User\Show\ShowUserService;

class UserController
{
    public function index(): View
    {
        $service = new IndexUserService();
        $users = $service->execute();
        return new View('users', ['users' => $users]);
    }

    public function show(array $vars): View
    {
        try {
            $userId = $vars['id'];
            $service = new ShowUserService();
            $request = $service->execute(new ShowUserRequest((int)$userId));
            $response = new ShowUserResponse($request->getUser(), $request->getArticles());
            return new View('singleUser',
                [
                    'user' => $response->getUser(),
                    'articles' => $response->getArticles()
                ]);
        }catch (RecourseNotFoundException $exception){
            return new View('notFound', []);
        }
    }
}