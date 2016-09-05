## Template Pattern Example
First example of how to use **Template Pattern** is implementation of **MyHTMLTemplate** . <br />
Whole idea behind it is to **define template which is inherited by child classes and reused in them**. <br />
Instead of copying code for each concrete class, you can define **template class** to hold all the common elements,<br />
common structure, and common behavior.<br />
This design pattern is created mainly to avoid repeating the code.<br />
[TemplatePatternExample.php](TemplatePatternExample.php)<br />
Characteristics of this implementation:
 1. abstract class which defines overall structure of the template
 2. child classes which define particular custom elements
 3. very small, atomic methods to provide maximum flexibility in child classes
 4. defined skeleton but without detailed implementation of each element

## Summary
### Pros
 1. highly reusable code
 2. flexibility
 3. possibility to force creation of certain elements (via abstract methods)

### Cons
 1. even most flexible templates can prove not flexible enough, and then redefinition of template is required.