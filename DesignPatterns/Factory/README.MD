## Factory Pattern Example
First example of how to use **Factory Pattern** is very simple implementation of **DatabaseFactory**. <br />
Whole idea behind it is to **construct different objects** in a factory dependent on few parameters. <br />
[FactoryPatternExample.php](FactoryPatternExample.php)<br />
Characteristics of this implementation:
 1. separated factory class to instantiate different object
 2. possibility to store instances as singletons inside factory
 3. all instantiations of the certain group of objects (database implementations) take place in factory

## Summary
### Pros
 1. separated instantiation logic from using logic
 2. easily shared configuration between different objects
 3. implementation independency when using interfaces inside factory

### Cons
 1. with many different objects and configurations factory may grow large and complicated
 2. every new instance configuration of certain object implicates change in factory
