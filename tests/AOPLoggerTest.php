<?php

namespace MySelf\AOP;

use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

class AOPLoggerTest extends TestCase
{
    public function testLogger()
    {
        $object = $this->dummyObject();
        $logger = $this->loggerMock();
        $logger->expects($this->once())
            ->method('info')
            ->with("Called Anonymous->add() with arguments: [1,2,2]");

        $aopObject = new AOPLogger($object, $logger);

        $this->assertEquals(5, $aopObject->add(1, 2, 2));
    }

    public function testLoggerWithException()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("Error on Anonymous->add() call");

        $object = $this->dummyObject();
        $logger = $this->loggerMock();
        $logger->expects($this->once())
            ->method('error')
            ->with("Argument 3 passed to class@anonymous::add() must be of the type int, string given");

        $aopObject = new AOPLogger($object, $logger);

        $aopObject->add(1, 2, 'b');
    }

    private function dummyObject()
    {
        return new class {
            public function add(int ...$numbers): int
            {
                return array_sum($numbers);
            }
        };
    }

    private function loggerMock()
    {
        return $this->createMock(LoggerInterface::class);
    }
}
