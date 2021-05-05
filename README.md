# Medusa Validations
## Goals
This library is created to provide a common interface for simple scalar value validations in an OOP way.

## Examples
Lets have a look at some examples of how to use these Validations, at first we will see how so use it to
validate an value.

```php
use Medusa\Validation\HashValidation;use Medusa\Validation\Result\ResultInterface;

$val = new HashValidation(32);  // validate for hashes with a length of 32
/** @var ResultInterface $res */
$res = $val->validate('asdf');
```

that way you can use most of the provides Validation classes. As next step let's see how to work
with results in the most simple way.

```php
use Medusa\Validation\Result\ResultInterface;
/** @var ResultInterface $res */
if ($res->isValid()) {
    echo 'yeah - its a valid hash-32';
} else {
    echo 'oh no someethin went wrong...';
    echo $res->getReason();
}
```

for further information in a technical perspective you can also have a look at ReturnCodes.

```php
use Medusa\Validation\HashValidation;
use Medusa\Validation\Result\ResultInterface;
/** @var ResultInterface $res */
if ($res->isValid()) {
    echo 'fine again :)';
} else {
    // 'oh no - not again';
    if ($res->getReturnCode() === HashValidation::INVALID_CHARACTER_OUT_OF_BOUNDS) {
        // ok give advice what went wrong
    }
}
```