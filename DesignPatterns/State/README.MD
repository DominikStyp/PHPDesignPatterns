## State Pattern Example
First example of how to use **State Pattern** is very simple implementation of **UserState**. <br />
Whole idea behind it is to **separate code for each object state to different class** and that's it. <br />
[StatePatternExample.php](StatePatternExample.php)<br />
Characteristics of this implementation:
 1. main interface for all states (UserStateI)
 2. all states in separate classes (UserStateLoggedIn, UserStateLoggedOut)
 3. all state classes instantiated in main class (User) constructor
 4. defined current state of the main object
 5. all state objects can have access to the main object (User) to change it's state
 6. all main object's actions related with state (login, logout, postMessage), <br />
 are invoked by current state object, represented by interface. <br />

## Summary
### Pros
 1. very well separated code
 2. possibility of having more than 10 states of the object and still have readable code
 3. flexible code in each state (you don't have to change User class each time you want to affect User state).

### Cons
 1. many classes and lots of code
 2. any additional user action added to the interface needs to be implemented in each state (or at least mocked).
 3. each state should is able to change object's state, so it may be harder to debug when this happens.
