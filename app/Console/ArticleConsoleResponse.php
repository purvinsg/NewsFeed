<?php declare(strict_types=1);

namespace App\Console;

require_once __DIR__ . '/ConsoleRouter.php';
require_once __DIR__ . '/../Core/View.php';
require_once __DIR__ . '/../Models/Article.php';
require_once __DIR__ . '/../Models/Comment.php';
require_once __DIR__ . '/../Services/Article/IndexArticleService.php';
require_once __DIR__ . '/../Services/Article/Show/ShowArticleRequest.php';
require_once __DIR__ . '/../Services/Article/Show/ShowArticleService.php';
require_once __DIR__ . '/../Services/Article/Show/ShowArticleResponse.php';
require_once __DIR__ . '/../Exceptions/RecourseNotFoundException.php';

use App\Models\Article;
use App\Models\Comment;
use App\Services\Article\IndexArticleService;
use App\Services\Article\Show\ShowArticleRequest;
use App\Services\Article\Show\ShowArticleService;

class ArticleConsoleResponse
{
    private IndexArticleService $indexArticleService;
    private ShowArticleService $showArticleService;

    public function __construct(IndexArticleService $indexArticleService, ShowArticleService $showArticleService)
    {
        $this->showArticleService = $showArticleService;
        $this->indexArticleService = $indexArticleService;
    }

    public function execute($id): void
    {
        if (!$id) {
            $this->index();
            exit;
        }
        $this->show($id);
    }

    public function index(): void
    {
        $service = $this->indexArticleService;
        $articles = $service->execute();
        $this->printIndex($articles);
    }

    public function show($id): void
    {
        $service = $this->showArticleService;
        $response = $service->execute(new ShowArticleRequest($id));
        $this->printShow($response->getArticle(), $response->getComments());
    }

    private function printIndex(array $articles): void
    {
        /** @var Article $article */
        foreach ($articles as $article) {
            echo '~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~' . PHP_EOL;
            echo '~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~' . PHP_EOL;
            echo '~~~~~~~~~~ Article ID: ' . $article->getId() . PHP_EOL;
            echo '~~~~~~~~~~ Article title: ' . $article->getTitle() . PHP_EOL;
            echo $article->getBody() . PHP_EOL;
            echo '~~~~~~~~~~ Written by: ' . $article->getAuthor()->getName() . PHP_EOL;
            echo '~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~' . PHP_EOL;
            echo '~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~' . PHP_EOL;
        }
    }

    private function printShow(Article $article, array $comments)
    {
        echo '~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~' . PHP_EOL;
        echo '~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~' . PHP_EOL;
        echo '~~~~~~~~~~ Article title: ' . $article->getTitle() . PHP_EOL;
        echo '~~~~~~~~~~ body: ' . $article->getBody() . PHP_EOL;
        echo '~~~~~~~~~~ Written by:  ' . $article->getAuthor()->getName() . PHP_EOL;
        echo '~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~' . PHP_EOL;
        echo 'Comments: ' . PHP_EOL;
        /** *  @var Comment $comment */
        foreach ($comments as $comment) {
            echo '~~~~~~~~~~ Comment title: ' . $comment->getName() . PHP_EOL;
            echo '~~~~~~~~~~ Body: ' . $comment->getBody() . PHP_EOL;
            echo '~~~~~~~~~~ Author: ' . $comment->getEmail() . PHP_EOL;
            echo '~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~' . PHP_EOL;
            echo '~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~' . PHP_EOL;
        }
    }
}
