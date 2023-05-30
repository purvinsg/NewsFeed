<?php

use App\Repositories\Article\ArticleRepository;
use App\Repositories\Article\JsonPlaceholderArticleRepository;
use App\Repositories\Article\NewsFeedDBArticleRepository;
use App\Repositories\Comments\CommentRepository;
use App\Repositories\Comments\JsonPlaceholderCommentsRepository;
use App\Repositories\Comments\NewsFeedDBCommentsRepository;
use App\Repositories\User\JsonPlaceholderUserRepository;
use App\Repositories\User\UserRepository;
use App\Repositories\User\NewsFeedDBUserRepository;

return [
    'classes' => [
        ArticleRepository::class => DI\create(NewsFeedDBArticleRepository::class),
        UserRepository::class => DI\create(NewsFeedDBUserRepository::class),
        CommentRepository::class => DI\create(NewsFeedDBCommentsRepository::class),
    ],
];
