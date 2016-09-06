## Memento Pattern Example
Whole idea behind it is to **implement ability to save/restore versions of the object (originator)<br />
in other classes: memento which represents version, caretaker which holds versions**. <br />

First example of how to use **Memento Pattern** is simple implementation 3 actors: <br />
 1. Memento (memento - class that represents the version)
 2. Versioner (caretaker - which holds different versions (references to Memento instances) )
 3. Note (originator - class which requires to be versioned)

[MementoPatternExample.php](MementoPatternExample.php)<br />
Characteristics of this implementation:
 1. there are always 3 classes: memento, caretaker and originator
 2. originator can change it states (versions) from memento (by reading its state)
 3. different versions (mementos) are holded by caretaker

## Summary
### Pros
 1. separated responsibility of each actor
 2. flexibility of adding new information to saved states via memento class (creation time, modification time etc.)
 3. originator can read/store different kind of information in memento (even serialized objects etc.)

### Cons
 1. more classes to deal with
 2. refactoring of originator implicates changes in memento.
