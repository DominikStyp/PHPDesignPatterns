## Visitor Pattern Example
First example of how to use **Visitor Pattern** is implementation of **HomeDevicesTurnedOnChecker** . <br />
Whole idea behind it is to **invoke actions on classes via common accept() method, which "invites" visitor object<br />
to its inside, and can provide it with all necessary information (including private variables etc.)**.<br />
In the following example there are 3 devices: Laptop, TV and WashingMachine. <br />
Each of them need to be checked if they're currently turned on, but they don't have common method to do that.<br />
For that purpose I've implemented **visitor class** called **HomeDevicesTurnedOnChecker**, which will check each of them <br />
using its specific method to check the status. <br />
[VisitorPatternExample.php](VisitorPatternExample.php)<br />

In the another example [VisitorPatternExample1.php](VisitorPatternExample1.php) we have hospital patients (visitables), and nurses (visitors). <br />
Every nurse (visitor) has her own responsibility: <br /> 
 1. Nurse1 is checking the patients pulse, and alerts personnel if any life is in danger
 2. Nurse2 is checking whether babies are hungry and feed them if needed
 3. Nurse3 is checking whether old people are bored and turns on the TV if that's the case <br />
<br />

Characteristics of this implementation:
 1. similar to Observer Pattern, but without noticing about the events.
 2. every class which can "invite" the visitor implements **accept()** method
 3. every visitor should implement common **visit()** method, through which host class can pass all the information

## Summary
### Pros
 1. visitors are decoupled from visited classes
 2. possibility to implement unlimited number of visitor to each particular class
 3. very useful with bigger classes that need things like validation, status checking etc.
 4. implementing **Visitable** interface requires to add only one method to each class

### Cons
 1. more classes and files to deal with
 2. you have to be careful with refactoring each class that implements Visitable interface, cause some visitors may stop working.