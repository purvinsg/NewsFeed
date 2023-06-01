<?php declare(strict_types=1);

namespace App\Controllers\Comment;

use App\Core\Redirect;
use App\Core\Session;
use App\DataCheck;
use App\Services\Comment\CreateCommentRequest;
use App\Services\Comment\CreateCommentService;

class CommentController
{
    private CreateCommentService $createCommentService;

    public function __construct(CreateCommentService $createCommentService)
    {
        $this->createCommentService = $createCommentService;
    }

    public function create(array $vars): Redirect
    {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $articleId = (int)$vars['id'];

        if (DataCheck::comment($title, $content)) {
            Session::flash('title', $title);
            Session::flash('content', $content);
            header('Location: /articles/' . $articleId);
            exit();
        }

        $user = Session::getFlashed('user');
        $comment = $this->createCommentService->execute(
            new CreateCommentRequest(
                $articleId,
                $title,
                $content,
                $user->getId(),
            ));

        return new Redirect('/articles/' . $comment->getArticleId());
    }
}
