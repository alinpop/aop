<?php

use MySelf\AOP\HighLevelClass;
use MySelf\AOP\HighLevelClassFactory;

include __DIR__ . "/vendor/autoload.php";

/** @var HighLevelClass $highLevelObject */
$highLevelObject = (new HighLevelClassFactory())->get();

try {
    $highLevelObject->get();
} catch (\Throwable $exception) {
    // the error is already logged by the AOP class
}

$highLevelObject->setProperty('some-value');

$value = $highLevelObject->getProperty();
var_dump($value);

$highLevelObject->setProperty(function(){echo "55";});