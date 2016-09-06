## Iterator Pattern Example
First example of how to use **Iterator Pattern** is very simple implementation of built-in **Iterator** interface. <br />
Whole idea behind it is to **be able to iterate over object property/properties in foreach or while loop**. <br />
[IteratorPatternExample.php](IteratorPatternExample.php)<br />
Characteristics of this implementation:
 1. implements built-in SPL interface **Iterator**
 2. has to have internal counter/limiter which prevents the loop from iterating infinitely
 3. has to have property/properties over which it can iterate (like array, generator, resource)
 4. has to have a starting point (like counter which begins with certain number)
 5. has to save its current state in some property, so that **next()** method can move it step forward (add 1 to the counter)
 6. has to have finish point, so that **valid()** method checks if it's reached (like 1 more than maximum number is not valid)

## Summary
### Pros
 1. ability to pass instance of the object to every foreach loop

### Cons
 1. many methods to implement, in more complicated objects logic can be quite complicated
