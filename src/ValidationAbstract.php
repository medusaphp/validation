<?php declare(strict_types = 1);
namespace Medusa\Validation;

use Medusa\Validation\Result\ResultInterface;

/**
 * Class ValidationAbstract
 * @package medusa/validation
 * @author  Pascal Schnell <pascal.schnell@getmedusa.org>
 */
abstract class ValidationAbstract implements ValidationInterface {

    /**
     * @param mixed $value
     * @csIgnoreParamType $value could be anything
     * @return ResultInterface
     */
    public function validate($value): ResultInterface {

        foreach ($this->dependsOn() as $validation) {

            $result = $validation->validate($value);

            if (!$result->isValid()) {
                return $result;
            }

            $value = $result->getValue();
        }

        return $this->doValidation($value);
    }

    /**
     * @param mixed $value
     * @csIgnoreParamType $value could be anything
     * @return ResultInterface
     */
    abstract protected function doValidation($value): ResultInterface;
}
