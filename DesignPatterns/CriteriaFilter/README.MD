## Criteria Filter Pattern Example
First example of how to use **Criteria Filter** shows implementation of **Criteria** interface. <br />
Whole idea behind it is to **shift logic concerning filters to other classes that implement common interface** <br />,
and also have ability to chain filters. <br />
In the following example, I've created couple of classes to filter array with different conditions.<br />

[CriteriaFilterPatternExample.php](CriteriaFilterPatternExample.php)<br />
Characteristics of this implementation:
 1. every filter must implement method **meetCriteria()** which returns filtered input
 2. filter chains like **AndCriteria**, **OrCriteria** can chain multiple filters

## Summary
### Pros
 1. very well separated code
 2. completely decoupled classes (only common interface connects their behavior).
 3. possibility of mixing filters in desired order

### Cons
 1. many classes and lots of code
 2. any additional action added to the interface needs to be implemented in each filter.
