<?php declare(strict_types = 1);
namespace Medusa\Validation;

use Medusa\Validation\Result\InvalidResult;
use Medusa\Validation\Result\ResultInterface;
use Medusa\Validation\Result\ValidResult;
use function is_array;

/**
 * @package medusa/validation
 * @author  Pascal Schnell <pascal.schnell@getmedusa.org>
 */
class MandatoryValidation implements ValidationInterface {

    /**
     * @param mixed $value
     * @csIgnoreParamType $value could be anything
     * @return ResultInterface
     */
    public function validate($value): ResultInterface {
        if (!$this->exists($value)) {
            return new InvalidResult($value, 'Mandatory');
        }
        return new ValidResult($value);
    }

    /**
     * @param mixed $data
     * @csIgnoreParamType $data could be anything
     * Check if a value is present (not null and not empty string and no empty arrays)
     * @return bool
     */
    private function exists($data): bool {
        return !($data === null || $data === '' || (is_array($data) && count($data) === 0));
    }

    /**
     * @return array
     */
    public function dependsOn(): array {
        return [];
    }
}
