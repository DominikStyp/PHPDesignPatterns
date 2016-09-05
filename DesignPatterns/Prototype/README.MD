## Prototype Pattern Example
First example of how to use **Prototype Pattern** is very simple implementation of **ShapeFactory**. <br />
Whole idea behind it is to **decrease the number of "new" keyword usage, and use cloning instead**. <br />
[PrototypePatternExample.php](PrototypePatternExample.php)<br />
Characteristics of this implementation:
 1. Factory class which is creating object clones
 2. Using interface (or abstract class) as a return type from the cloning method

## Summary
### Pros
 1. when many similar objects are created via **new keyword**, Prototype Pattern may increase efficiency, <br />
 since cloning is faster than creating new objects.
 2. better control over creating new instances in the code
 3. all data that needs to be passed to the class constructor may be encapsulated in factory class

### Cons
 1. each time you need to change parameters passed to the constructor, you need to change cloning method
 2. object constructors with many parameters (obligatory and optional) are not suitable for cloning methods.
