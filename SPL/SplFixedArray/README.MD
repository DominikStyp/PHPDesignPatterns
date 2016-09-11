# SplFixedArray
It's almost the same as regular array with numeric consecutive indexes.<br />
Crucial difference is that you can't add new elements to it (only change existing).<br />
This is useful if you have large loops that fill array with thousands of elements, <br />
and you need to improve performance.

## Pros
 1. about 22% faster than regular array.
 2. object oriented, so also **extendable**.
 3. flexible in terms of iteration behavior, array access behavior etc.

## Cons
 1. you can't add new elements via `$arr[] = 'new element';`
 2. you have to define it's length during declaration
 3. doesn't allow string keys (only integers)

## Summary
It's not useful unless you have arrays filled with thousands of elements, and numeric keys,<br />
then you can replace it to **SplFixedArray** to improve performance.<br />
But those are rather rarely cases in common web design.

