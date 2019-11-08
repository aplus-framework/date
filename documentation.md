# Date Library *documentation*

The Date class adds some functionality to the DateTime class.

Where it implements the `JsonSerializable` interface. Optimizing work with APIs by turning the Date object into a string in ATOM format.

Example using the `__toString` method:

```php
use Framework\Date\Date;

$date = new Date();
echo "$date"; // 2019-11-08T15:40:57-03:00
```
