<?php declare(strict_types=1);

use App\Console\ConsoleRouter;
require_once __DIR__ . '/app/Console/ConsoleRouter.php';

require_once 'vendor/autoload.php';

$response = ConsoleRouter::route($argv);

if(!$response){
    echo '~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~'.PHP_EOL;
    echo '~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~'.PHP_EOL;
    echo 'Command not found!'.PHP_EOL;
    echo 'Commands: users, articles, users ID, articles ID'.PHP_EOL;
    echo '~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~'.PHP_EOL;
    echo '~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~'.PHP_EOL;
}else {
    $response->execute();
}
