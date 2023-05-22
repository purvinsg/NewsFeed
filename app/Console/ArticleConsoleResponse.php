<?php declare(strict_types=1);

namespace App\Console;

require_once __DIR__ . '/ConsoleRouter.php';
require_once __DIR__ . '/../Core/View.php';
require_once __DIR__ . '/../Models/Article.php';
require_once __DIR__ . '/../Models/Comment.php';
require_once __DIR__ . '/../Services/Article/indexArticleService.php';
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
    private ?int $id;

    public function __construct(?int $id)
    {
        $this->id = $id;
    }

    public function execute(): void
    {
        if (!$this->id) {
            $this->index();
            exit;
        }
        $this->show();
    }

    public function index(): void
    {
        $service = new IndexArticleService();
        $articles = $service->execute();
        $this->printIndex($articles);
    }

    public function show(): void
    {
        $service = new ShowArticleService();
        $response = $service->execute(new ShowArticleRequest($this->id));
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
