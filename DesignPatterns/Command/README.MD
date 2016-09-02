## Command Pattern Example
First example of how to use **Command Pattern** is very simple implementation of **CommandI** interface. <br />
Whole idea behind it is to **move some commands/tasks invocations to the separated classes**. <br />
[CommandPatternExample.php](CommandPatternExample.php)<br />
Example of this implementation you can find in Symfony framework: <br />
http://symfony.com/legacy/doc/cookbook/1_1/en/tasks <br />
Characteristics of this implementation:
 1. every class implements Command interface with one abstract method execute()
 2. there is separate class Invoker which can invoke sets of commands (ex. from array)

## Summary
### Pros
 1. separate set of commands/tasks logic, from other logic
 2. consistent implementation of execute() in every command reduces logic error probability.

### Cons
 1. many classes and files to deal with
