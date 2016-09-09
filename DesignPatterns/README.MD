## Design Patterns
First of all, **Design Patterns** is not necessary to resolve many existing programming problems <br />
however they can significantly speed up the resolution, make the code neat, clean, reusable, and decoupled.<br />
The most important word here is **decoupled**. That means every concrete class should be **independent on the others**, <br />
but only on interfaces/abstract classes which other classes implement/extend.<br />

### Creational Patterns
This type of patterns are responsible for creating new objects, <br />
and are mainly used to simplify, speed up, or decouple this process, and eliminate possible duplicate code. <br />
Most popular in this category are:
 1. [Builder](Builder) - creates complex objects, separates construction from representation
 2. [Factory](Factory) - creates different types of objects based on the same interfaces but with different implementations
 3. [Factory Method](FactoryMethod) - same as factory, but with abstract factory class, and children factories that implement abstract methods.
 4. [Prototype](Prototype) - clones created object, used to speed up the process and minimize usage of **new** keyword in your code
 5. [Singleton](Singleton) - creates ONE instance of the object, holds it in static variable, and serves reference to it.

### Structural Patters
Most popular in this category are:
 1. [Adapter](Adapter) - works like real world adapter, imagine this as USB cable with USB plug on one end, and PS2 on the other. <br /> Main role of the adapter is to get object with one type, and return other type (created from the input type).
 2. [Criteria Filter](CriteriaFilter) - implements **Criteria** interface which allows to chain filters in choosed order. <br /> 
                                        It's very similar to Decorator Pattern.
 3. [Decorator](Decorator) - have ability to **wrap one functionality in another** like `decorator3(decorator2(decorator1(input)))` dynamically.
 4. [Facade](Facade) - hides more complicated logic in it, best example is database method which takes SQL and retrieves the result,<br />
                       and hides all the complicated logic like: connect to database, choose database, fetch records - all happens behind the scenes.
 5. [Proxy](Proxy) - representation of one object in the other object, it's very similar to the Adapter, with one difference,<br />
                     Proxy outputs **same type of interface, or base class - that input object implement/inherit**. <br />
                     It's mainly used to **limit access to some methods in the input class**. <br />
 6. Flyweight - provides efficient sharing, and reusing of already created objects, this can be also achieved by Factory. <br />
 

### Behavioural Patterns
 1. [Chain of responsibility](ChainOfResponsibility) - if object cannot fulfill the task, it pushes it to the next in chain. <br />
    Real world example would be chain in a restaurant: Waiter -&gt; Order Receiver -&gt; Chef -> Cook <br />
 2. [Command](Command) - similar to **Facade Pattern**, encapsulates the ready to use chain of actions in **execute()** method. <br />
 3. [Iterator](Iterator) - changes object to iterable, so you can pass it into **foreach** or **while** loop <br />
 4. [Memento](Memento) - can store different states of the object, and restore object to it's previous state if needed.
 5. [Observer](Observer) - listens to the events, that object emits via **notify()** method, and reacts to those events. <br />
 6. [State](State) - alters object's behavior, when its state changes, good example is **User** who can be logged-in or logged-out,<br />
                     in every state this object should act differently, like allowing only logged-in user to do some actions etc. <br />
 7. [Strategy](Strategy) - alters program flow in runtime without changing its code <br />
 8. [Template](Template) - every PHP file which spits out HTML based on some PHP variables is the template example.<br />
 9. [Visitor](Visitor) - similar to Strategy. There is a visitor which can **visit** the object via **accept()** method, <br />
                         and retrieve some data, or change object's properties <br />
