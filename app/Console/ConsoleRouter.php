<?php declare(strict_types=1);

namespace App\Console;
require_once __DIR__ . '/ArticleConsoleResponse.php';
require_once __DIR__ . '/UserConsoleResponse.php';
require_once __DIR__ . '/../Core/Container.php';

class ConsoleRouter
{
    private Container $container;

    public function __construct(){
        $this->container = new Container();
    }

    public function route(array $argv)
    {
        $commands = [
            'articles' => ArticleConsoleResponse::class,
            'users' => UserConsoleResponse::class
        ];

        $command = $argv[1] ?? null;
        $id = isset($argv[2]) ? (int)$argv[2] : null;

        if(array_key_exists($command, $commands)){
            $response = $this->container->getContainer()->get($commands[$command]);
            return $response->execute($id);
        }
        return null;
    }
}
