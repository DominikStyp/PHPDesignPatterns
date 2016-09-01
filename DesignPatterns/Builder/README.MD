## Builder Pattern Example
First example of how to use **Builder Pattern** is basic implementation of **AddressBuilderUS**. <br />
Whole idea behind it is to **build (construct and setup) objects in separate classes** <br />
[BuilderPatternExample.php](BuilderPatternExample.php)<br />
Characteristics of this implementation:
 1. separated class to instantiate different objects
 2. similarity to [Factory Pattern)(../Factory)
 3. logic of instantiating and setting up object values are separated from the main class

## Summary
### Pros
 1. separated instantiation and setting up logic from internal object logic
 2. very readable and flexible code
 3. possibility of having multiple builders for the one object

### Cons
 1. need to change the builders each time structure of the main object changes

