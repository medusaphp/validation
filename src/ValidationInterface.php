<?php declare(strict_types = 1);
namespace Medusa\Validation;

use Medusa\Validation\Result\ResultInterface;

/**
 * @package medusa/validation
 * @author  Pascal Schnell <pascal.schnell@getmedusa.org>
 */
interface ValidationInterface {

    /**
     * @param mixed $value
     * @csIgnoreParamType $value could be anything
     * @return ResultInterface
     */
    public function validate($value): ResultInterface;

    /**
     * @return ValidationInterface[]
     */
    public function dependsOn(): array;
}
