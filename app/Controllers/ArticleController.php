<?php declare(strict_types=1);

namespace App\Controllers;
require_once __DIR__ . '/../ApiClient.php';
require_once __DIR__ . '/../Core/View.php';
require_once __DIR__ . '/../Services/Article/indexArticleService.php';
require_once __DIR__ . '/../Services/Article/Show/ShowArticleRequest.php';
require_once __DIR__ . '/../Services/Article/Show/ShowArticleService.php';
require_once __DIR__ . '/../Services/Article/Show/ShowArticleResponse.php';
require_once __DIR__ . '/../Exceptions/RecourseNotFoundException.php';

use App\Core\View;
use App\Exceptions\RecourseNotFoundException;
use App\Services\Article\IndexArticleService;
use App\Services\Article\Show\ShowArticleRequest;
use App\Services\Article\Show\ShowArticleService;


class ArticleController
{
    public function index(): View
    {
        $service = new IndexArticleService();
        $articles = $service->execute();

        return new View('articles', ['articles' => $articles]);
    }

    public function show(array $vars): View
    {

        try {
            $articleId = $vars['id'] ?? null;
            $service = new ShowArticleService();
            $response = $service->execute(new ShowArticleRequest((int)$articleId));
        } catch (RecourseNotFoundException $exception) {
            return new View('notFound', []);
        }

        return new View('singleArticle',
            [
                'article' => $response->getArticle(),
                'comments' => $response->getComments()
            ]);
    }

}