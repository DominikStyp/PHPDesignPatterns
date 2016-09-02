## Strategy Pattern Example
First example of how to use **Strategy Pattern** is implementation of **PricingStrategyI** . <br />
Whole idea behind it is to **have ability to change program execution path without modifying code of the target class**. <br />
Instead of making lots of IF/ELSE or SWITCH statements inside the methods, which makes code unreadable, <br />
you can use this strategy to separate different possible paths of execution to different classes.<br />
But the most important is that you have **flexibility to changing strategies outside the class code, in runtime**. <br />
[StrategyPatternExample.php](StrategyPatternExample.php)<br />
Characteristics of this implementation:
 1. base Strategy Interface implemented by every strategy path
 2. possibility to change the strategy via setter methods

## Summary
### Pros
 1. separate different paths of program execution to different classes clears the code
 2. code is more flexible to change or add new strategies - without modifying target class.

### Cons
 1. many classes and files to deal with