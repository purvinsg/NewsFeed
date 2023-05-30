<?php declare(strict_types=1);

namespace App\Services\Article;

use App\Models\Article;
use App\Repositories\Article\ArticleRepository;
use App\Repositories\User\UserRepository;

class IndexArticleService
{
    private ArticleRepository $articleRepository;
    private UserRepository $userRepository;

    public function __construct(ArticleRepository $articleRepository, UserRepository $userRepository)
    {
        $this->articleRepository = $articleRepository;
        $this->userRepository = $userRepository;
    }

    public function execute(): array
    {
        $articles = $this->articleRepository->all();
        /** @var Article $article */
        foreach ($articles as $article) {
            $author = $this->userRepository->getById($article->getAuthorId());
            $article->setAuthor($author);
        }
        return $articles;
    }
}