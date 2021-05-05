<?php declare(strict_types = 1);
namespace Medusa\Validation;

use Medusa\Validation\Result\InvalidResult;
use Medusa\Validation\Result\ResultInterface;
use Medusa\Validation\Result\ValidResult;
use function filter_var;
use function is_bool;
use const FILTER_NULL_ON_FAILURE;
use const FILTER_VALIDATE_BOOLEAN;

/**
 * Class BooleanValidation
 * @package medusa/validation
 * @author  Pascal Schnell <pascal.schnell@getmedusa.org>
 */
class BooleanValidation extends ValidationAbstract {

    private bool $strict;

    /**
     * BooleanValidation constructor.
     * @param bool $strict
     */
    public function __construct(bool $strict) {
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
    protected function doValidation($value): ResultInterface {

        if ($this->strict) {

            if (!is_bool($value)) {
                return new InvalidResult($value, 'must be boolean (strict mode=on)');
            }
        } elseif (($value = filter_var($value, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE)) === null) {
            return new InvalidResult($value, 'must be boolean (strict mode=off)');
        }

        return new ValidResult($value);
    }
}
