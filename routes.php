<?php declare(strict_types=1);


return [
    ['GET', '/', ['App\Controllers\Article\ArticleController', 'index']],
    ['GET', '/articles', ['App\Controllers\Article\ArticleController', 'index']],
    ['GET', '/articles/{id:\d+}', ['App\Controllers\Article\ArticleController', 'show']],

    ['GET', '/articles/edit/{id:\d+}', ['App\Controllers\Article\ArticleController', 'edit']],
    ['POST', '/articles/edit/{id:\d+}', ['App\Controllers\Article\ArticleController', 'update']],

    ['GET', '/articles/create', ['App\Controllers\Article\ArticleController', 'create']],
    ['POST', '/articles', ['App\Controllers\Article\ArticleController', 'store']],

    ['POST', '/articles/delete/{id:\d+}', ['App\Controllers\Article\ArticleController', 'delete']],

    ['GET', '/users', ['App\Controllers\User\UserController', 'index']],
    ['GET', '/users/{id:\d+}', ['App\Controllers\User\UserController', 'show']],

    ['GET', '/register', ['App\Controllers\User\RegisterController', 'register']],
    ['POST', '/register', ['App\Controllers\User\RegisterController', 'store']],

    ['GET', '/login', ['App\Controllers\User\LoginController', 'index']],
    ['POST', '/login', ['App\Controllers\User\LoginController', 'login']],
    ['POST', '/logout', ['App\Controllers\User\LoginController', 'logout']],

    ['POST', '/comment/{id:\d+}', ['App\Controllers\Comment\CommentController', 'create']],
];