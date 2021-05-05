<?php declare(strict_types = 1);
namespace Medusa\Validation;

use Medusa\Validation\Result\InvalidResult;
use Medusa\Validation\Result\ResultInterface;
use Medusa\Validation\Result\ValidResult;
use function is_int;
use function is_scalar;

/**
 * @package medusa/validation
 * @author  Pascal Schnell <pascal.schnell@getmedusa.org>
 */
class IntegerValidation implements ValidationInterface {

    private bool $strict;

    /**
     * IntegerValidation constructor.
     * @param bool $strict
     */
    public function __construct(bool $strict = false) {
        $this->strict = $strict;
    }

    /**
     * @return array
     */
    public function dependsOn(): array {
        return [];
    }

    /**
     * @param mixed $value
     * @csIgnoreParamType $value could be anything
     * @return ResultInterface
     * @throws Exception\ValidationException
     */
    public function validate($value): ResultInterface {

        if (is_int($value)) {
            return new ValidResult($value);
        }

        if ($this->strict) {
            return new InvalidResult($value, 'value must be an integer (strict mode=on)');
        }

        if (!is_scalar($value)) {
            return new InvalidResult($value, 'value must be an integer (non scalar value given)');
        }

        $tmp = (int)$value;

        if ((string)$tmp === (string)$value) {
            return new ValidResult($tmp);
        }

        return new InvalidResult($value, 'value must be an integer');
    }
}
