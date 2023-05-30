<?php declare(strict_types=1);

namespace App\Services\Article\Create;

use App\Models\Article;
use App\Repositories\Article\NewsFeedDBArticleRepository;

class CreateArticleService
{
    private NewsFeedDBArticleRepository $repository;

    public function __construct(NewsFeedDBArticleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(CreateArticleRequest $request): CreateArticleResponse
    {
        $article = new Article(
            $request->getUserId(),
            $request->getTitle(),
            $request->getContent(),
            'https://placehold.co/600x400/gray/white?text=WOW',
        );
        $this->repository->store($article);

        return new CreateArticleResponse($article);
    }
}