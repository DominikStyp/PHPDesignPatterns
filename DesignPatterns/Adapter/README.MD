## Adapter Pattern Example
First example of how to use **Adapter Pattern** is basic implementation of **ForumUserAdapter**. <br />
Whole idea behind it is to **make adapter BETWEEN two different classes** <br />
Imagine that you have a cable with the USB plug on one end, and PS2 plug on the other - this is adapter.<br />
Same applies to the **adapter classes** - you get one class type and spit-out other type.
[AdapterPatternExample.php](AdapterPatternExample.php)<br />
Characteristics of this implementation:
 1. constructor takes an argument of an object which is gonna be adapted
 2. adapter class implements same interface (or inherits same class) as the class to which it adapts
 3. adapter can also be a static method which converts one object into another
 4. adapter should correctly setup all the output object properties which are set up via adapted class constructor

## Summary
### Pros
 1. flexibility in adaptation one class to another
 2. no need for changes in input (adapted) class

### Cons
 1. sometimes properties of the output object must be mocked (which can be hard to debug)
 2. every change in output type (interface or parent class) implicates changes in adapter.
 3. with bigger adapted classes adapters must implement complicated logic