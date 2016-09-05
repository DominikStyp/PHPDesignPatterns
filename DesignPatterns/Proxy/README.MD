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
 3. proxy class has access only to allowed methods (that's for what proxy is)

## Summary
### Pros
 1. safe data manipulation, and retrieve via proxy class
 2. much less methods on the IDE hint list (especially if you use small proxies for small purposes)
 3. possibility to add additional data filters in specific proxies (like XSS for templates)

### Cons
 1. More classes to maintain
 2. More work to do while refactoring the source classes
