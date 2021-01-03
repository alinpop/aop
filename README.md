# Aspect Oriented Programming with PHP

Aspect Oriented Programming represents a strategy to extract from the business logic cross-cutting
concerns like logging. What typically happens is that you inject the logger in all your high
level classes. Yet logging messages does not describe the business in any way.

PHP does not support directly Aspect Oriented Programming. You can only use your imagination to 
implement it. Here is a dummy example of a possible high level class `HighLevelClass` that does not have a 
logger and yet all the calls to public methods and all the errors thrown by them are logged.

The proposed solution has a wrapper class, `AOPLogger`, around the `HighLevelClass` that uses the 
magic method `__call()` to call the public methods of `HighLevelClass`, but adding some logging.

Running `php cli.php` will generate the following messages in `/logs/log`:
```
local-file-logger.INFO: Called MySelf\AOP\HighLevelClass->get() with arguments: [] [] []
local-file-logger.ERROR: call_user_func_array() expects parameter 1 to be a valid callback, class 'MySelf\AOP\HighLevelClass' does not have a method 'get' [] []
local-file-logger.INFO: Called MySelf\AOP\HighLevelClass->setProperty() with arguments: ["some-value"] [] []
local-file-logger.INFO: Called MySelf\AOP\HighLevelClass->getProperty() with arguments: [] [] []
local-file-logger.INFO: Called MySelf\AOP\HighLevelClass->setProperty() with arguments: [{}] [] []
local-file-logger.ERROR: Argument 1 passed to MySelf\AOP\HighLevelClass::setProperty() must be of the type string, object given [] []
```