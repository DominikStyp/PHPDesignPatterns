## Proxy Pattern Example
First example of how to use **Proxy Pattern** is very simple implementation of **UserTemplateProxy**. <br />
Whole idea behind it is to **restrict other class functionality using proxy class as a public accessor**. <br />
Let's consider the following example, where we have **User** class, with some public methods, like **getPassword()**,<br />
or **getEmail()**, and we want them to be public, because we use them in model classes,<br />
but we shall never use them in template - because it violates our portal data policy.<br />
Best way to avoid accidental display of restricted data, is to use **Proxy class**, which allows us to hide some data of the User class.<br />
[ProxyPatternExample.php](ProxyPatternExample.php)<br />
Characteristics of this implementation:
 1. proxy class stores an instance of source class (User) in private field
 2. source class should be passed to proxy class via constructor
 3. proxy class has access to

## Summary
### Pros
 1. less memory usage when reusing same instance of the big object, instead of creating new
 2. sharing variables across all references to the object

### Cons
 1. polymorphism is difficult to implement since getInstance is a static call,
 2. when using inheritance, you have to define **getInstance()** method in each child class,
 or use reflection, late static binding etc.
