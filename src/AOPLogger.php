<?php declare(strict_types=1);

namespace MySelf\AOP;

use Psr\Log\LoggerInterface;

class AOPLogger
{
    private object $object;
    private LoggerInterface $logger;
    private string $objectName;

    public function __construct(object $object, LoggerInterface $logger)
    {
        $this->object = $object;
        $this->objectName = $this->getClassName($object);
        $this->logger = $logger;
    }

    private function getClassName($object)
    {
        return (new \ReflectionClass($object))->isAnonymous() ?
            "Anonymous" :
            get_class($object);
    }

    public function __call(string $functionName , array $arguments)
    {
        $this->logger->info("Called {$this->objectName}->{$functionName}() with arguments: " . json_encode($arguments));

        try {
            return call_user_func_array([$this->object, $functionName], $arguments);
        } catch (\Throwable $exception) {
            $this->logger->error($exception->getMessage());

            throw new \Exception("Error on $this->objectName->{$functionName}() call", 500, $exception);
        }
    }
}
