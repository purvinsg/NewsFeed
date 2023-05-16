<?php declare(strict_types=1);

use App\Core\Renderer;
use App\Core\Router;

require_once '../vendor/autoload.php';
require_once '../app/Core/Router.php';
require_once '../app/Core/Renderer.php';

$path = Router::route();

$renderer = new Renderer();

echo $renderer->render($path);