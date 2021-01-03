<?php declare(strict_types=1);

namespace MySelf\AOP;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class HighLevelClassFactory
{
    public function get()
    {
        $logger = new Logger('local-file-logger');
        $logger->pushHandler(new StreamHandler(__DIR__ . '/../logs/log'));

        return new AOPLogger(
            new HighLevelClass(),
            $logger
        );
    }
}
