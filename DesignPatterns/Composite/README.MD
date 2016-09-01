## Composite Pattern Example
First example of how to use **Composite Pattern** is basic implementation of **BlogPostComponent**. <br />
Whole idea behind it is to **build (construct and setup) objects in separate classes** <br />
[CompositePatternExample.php](CompositePatternExample.php)<br />
Characteristics of this implementation:
 1. Object class and GroupOfObjects class implement same interface or inherit from same abstract class (Component)
 2. Prevent invoking unsupported methods in child classes by throwing exceptions
 3. GroupOfObjects contain array/collection of Component type objects
 4. GroupOfObjects class implements iteration over its components
 5. Good example of **Composite Pattern** are nested arrays:
 ```php
 $compositeArrays = [
   1, 2, [ 1, 2 ], 3, [ 1, [2, 3] ]
 ];
 ```

## Summary
### Pros
 1. very good to store nested objects like categories with products
 2. also great for producing HTML menus with categories and subcategories
 3. make iteration over nested objects piece a cake
 4. best for encapsulated logic regarding nested objects representation (string, JSON or other)

### Cons
 1. may be hard to debug (like all nested objects)

