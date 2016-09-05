## Chain of Responsibility Pattern Example
First example of how to use **Chain of Responsibility Pattern** is very simple implementation of **Chain** interface. <br />
Whole idea behind it is to **push the action to another class/method in chain, in case the current can't accomplish the task**. <br />
[ChainOfResponsibilityPatternExample.php](ChainOfResponsibilityPatternExample.php)<br />
Characteristics of this implementation:
 1. every class that will be in chain implements **Chain interface**
 2. every chained class can add another one to the chain
 3. this is very similar implementation to **Decorator Pattern**, with one difference,<br />
 if method can accomplish the task it breaks the chain and returns the expected value/result.

## Summary
### Pros
 1. useful in big classes with many if/else statements, which can be split up to smaller classes
 2. it strips class of many responsibilities in favor of one concrete.
 3. it gives flexible chain settings, where order of priorities can be easily changed
 4. practically unlimited classes in chain

### Cons
 1. many classes and files to deal with
 2. harder to read and debug especially with longer chains
