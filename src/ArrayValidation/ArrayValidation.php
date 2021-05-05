<?php declare(strict_types = 1);
namespace Medusa\Validation\ArrayValidation;

use Medusa\Validation\Exception\ValidationException;
use Medusa\Validation\Result\InvalidResult;
use Medusa\Validation\Result\ResultInterface;
use Medusa\Validation\Result\ValidResult;
use Medusa\Validation\ValidationAbstract;
use function is_array;

/**
 * Class ArrayValidation
 * @package medusa/validation
 * @author  Pascal Schnell <pascal.schnell@getmedusa.org>
 */
class ArrayValidation extends ValidationAbstract {

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
     * @throws ValidationException
     */
    protected function doValidation($value): ResultInterface {

        if (is_array($value)) {
            return new ValidResult($value);
        }

        return new InvalidResult($value, 'parameter must be of type array');
    }
}
