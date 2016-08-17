# This repo contains quick and useful examples in PHP
1. [SplObserver example](SplObserver/Subject.php) - uses implementation of the **SplObserver** class of **Standard PHP Library**.
This example shows how **NOT TO COPY** the same implementation code all over again in every class where you want to use **SplObserver**.
For that purpose I've used [PHP Traits](http://php.net/manual/en/language.oop5.traits.php) functionality, so every class that has to implement this interface just need to have the following statement: 
```php
class Example {
  use SplSubjectTrait;
}
```
