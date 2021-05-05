<?php declare(strict_types = 1);
namespace Medusa\Validation\Validator;

use Medusa\Validation\Result\ResultInterface;
use Medusa\Validation\Result\ValidResult;
use Medusa\Validation\ValidationInterface;

/**
 * Class ValidatorLogicOr
 * @package medusa/validation
 * @author  Pascal Schnell <pascal.schnell@getmedusa.org>
 */
class ValidatorLogicOr implements ValidationInterface {

    private array $validations = [];

    /**
     * ValidatorLogicOr constructor.
     * @param ValidationInterface ...$validations
     */
    public function __construct(ValidationInterface ...$validations) {
        $this->validations = $validations;
    }

    /**
     * @param mixed $value
     * @csIgnoreParamType $value could be anything
     * @return ResultInterface
     */
    public function validate($value): ResultInterface {

        if (!$this->validations) {
            return new ValidResult($value);
        }

        foreach ($this->validations as $validation) {

            $result = $validation->validate($value);

            if ($result->isValid()) {
                return $result;
            }
        }

        return $result;
    }

    /**
     * @return ValidationInterface[]
     */
    public function dependsOn(): array {
        return $this->validations;
    }
}
