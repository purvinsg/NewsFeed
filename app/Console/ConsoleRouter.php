<?php declare(strict_types=1);

namespace App\Console;
require_once __DIR__ . '/ArticleConsoleResponse.php';
require_once __DIR__ . '/UserConsoleResponse.php';
class ConsoleRouter
{
    public static function route(array $argv)
    {
        $command = $argv[1] ?? null;
        $id = isset($argv[2]) ? (int)$argv[2] : null;

        switch ($command) {
            case 'articles';
                return new ArticleConsoleResponse($id);
            case 'users';
                return new UserConsoleResponse($id);
            default:
                return null;
        }
    }
}
