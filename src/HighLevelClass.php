<?php declare(strict_types=1);

namespace MySelf\AOP;

class HighLevelClass
{
    private string $property;

    public function setProperty(string $value): void
    {
        $this->property = $value;
    }

    public function getProperty(): string
    {
        return $this->property;
    }
}
