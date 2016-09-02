## Facade Pattern Example
First example of how to use **Facade Pattern** is basic implementation of **ShopOrder**. <br />
Whole idea behind it is to **break code to smaller pieces (classes)** <br />
[FacadePatternExample.php](FacadePatternExample.php)<br />
Characteristics of this implementation:
 1. Bigger classes and methods are splitted into smaller fragments
 2. Each class has single responsibility (one purpose)
 3. Each method has one task
 4. The less actions/tasks class has - the better

## Summary
### Pros
 1. high code re-usage possibility
 2. understandable and readable code
 3. code easy to change and extend

### Cons
 1. many classes, methods and files to deal with
 2. coupled objects (lots of HAS-A relations)
