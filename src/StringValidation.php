<?php declare(strict_types = 1);
namespace Medusa\Validation;

use Medusa\Validation\Result\InvalidResult;
use Medusa\Validation\Result\ResultInterface;
use Medusa\Validation\Result\ValidResult;
use function is_scalar;
use function is_string;

/**
 * Class HashValidation
 * @package medusa/validation
 * @author  Pascal Schnell <pascal.schnell@getmedusa.org>
 */
class StringValidation implements ValidationInterface {

    private bool $strict;

    /**
     * StringValidation constructor.
     * @param bool $strict
     */
    public function __construct(bool $strict = false) {
        $this->strict = $strict;
    }

    /**
     * @param mixed $value
     * @csIgnoreParamType $value could be anything
     * @return ResultInterface
     */
    public function validate($value): ResultInterface {

        if ($this->strict) {
            if (!is_string($value)) {
                return new InvalidResult('value must be a string (strict mode=on)');
            }
            return new ValidResult($value);
        }

        if (!is_scalar($value)) {
            return new InvalidResult('value must be a string (strict mode=off)');
        }

        return new ValidResult((string)$value);
    }

    /**
     * @return array
     */
    public function dependsOn(): array {
        return [];
    }
}
