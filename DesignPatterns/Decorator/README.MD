## State Pattern Example
First example of how to use **Decorator Pattern** is very simple implementation of **Message**. <br />
Whole idea behind it is to **nest objects** in **HAS-A relationship** <br />
Method call of the outer-most decorator should work like this:
```php
$decorator2->getMessage( $decorator1->getMessage( $object->getMessage() ) );
```
[DecoratorPatternExample.php(DecoratorPatternExample.php)<br />
Characteristics of this implementation:
 1. every decorator HAS an instance of the primary object (Message), OR other decorator
 2. decorator and primary object share common interface (MessageI), which defines methods to manipulate objects data
 3. every decorator gets interface (MessageI) instance via constructor
 4. every decorator's method should call nested decorator's (OR main object's) method
 5. always assign most outer decorator instance to the variable of common interface type (MessageI).

## Summary
### Pros
 1. very well separated code
 2. possibility of mixing decorators in desired order
 3. possibility to change main object's properties via outer-most decorator (through nesting method calls)
 4. code that decorators share, can be easily separated to the trait

### Cons
 1. many classes and lots of code
 2. any additional action added to the interface needs to be implemented in each decorator.
