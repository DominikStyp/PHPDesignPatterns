## Factory Method Pattern Example
First example of how to use **Factory Method Pattern** is implementation of **AbstractFactory**. <br />
Whole idea behind it is to **make an abstract factory which has abstract method returning the interface, <br />
and which must be implemented in child factories to return concrete object**. <br />
[FactoryMethodPatternExample.php](FactoryMethodPatternExample.php)<br />
Characteristics of this implementation:
 1. abstract factory class
 2. abstract method returning interface (or abstract class) type
 3. child factory class which implements mentioned abstract method

## Summary
### Pros
 1. separated instantiation logic from other logic
 2. flexible abstract factory implementations in child factories
 3. reusable code in abstract factory

### Cons
 1. with many different objects and configurations factory may grow large and complicated
 2. every new instance configuration of certain object implicates change in factory
