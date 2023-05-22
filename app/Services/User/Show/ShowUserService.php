<?php declare(strict_types=1);

namespace App\Services\User\Show;

require_once __DIR__ . '/../../../Repositories/User/JsonPlaceholderUserRepository.php';
require_once __DIR__ . '/../../../Repositories/Article/JsonPlaceholderArticleRepository.php';
require_once __DIR__ . '/../../../Repositories/Comments/JsonPlaceholderCommentsRepository.php';
require_once __DIR__ . '/../../../Repositories/User/UserRepository.php';
require_once __DIR__ . '/../../../Repositories/Article/ArticleRepository.php';

use App\Exceptions\RecourseNotFoundException;
use App\Models\Article;
use App\Repositories\Article\ArticleRepository;
use App\Repositories\Article\JsonPlaceholderArticleRepository;
use App\Repositories\User\JsonPlaceholderUserRepository;
use App\Repositories\User\UserRepository;

class ShowUserService
{
    private UserRepository $userRepository;
    private ArticleRepository $articleRepository;

    public function __construct()
    {
        $this->userRepository = new JsonPlaceholderUserRepository();
        $this->articleRepository = new JsonPlaceholderArticleRepository();

    }
    public function execute(ShowUserRequest $request): ShowUserResponse
    {
        $user = $this->userRepository->getById($request->getUserId());

        if($user == null){
            throw new RecourseNotFoundException('User by id '.$request->getUserId().' not found');
        }

        $articles = $this->articleRepository->getByUserId($user->getId());
        /** @var Article $article */
        foreach ($articles as $article){
            $author = $this->userRepository->getById($article->getAuthorId());
            $article->setAuthor($author);
        }

        return new ShowUserResponse($user, $articles);
    }

}