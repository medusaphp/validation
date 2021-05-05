<?php declare(strict_types = 1);
namespace Medusa\Validation\Validator;

use Medusa\Validation\ValidationInterface;

/**
 * Class Validator
 * @package medusa/validation
 * @author  Pascal Schnell <pascal.schnell@getmedusa.org>
 */
class Validator extends ValidatorLogicAnd {

    /**
     * @param ValidationInterface ...$validations
     * @return ValidatorLogicOr
     */
    public static function or(ValidationInterface ...$validations): ValidatorLogicOr {
        return new ValidatorLogicOr(...$validations);
    }

    /**
     * @param ValidationInterface ...$validations
     * @return ValidatorLogicAnd
     */
    public static function and(ValidationInterface ...$validations): ValidatorLogicAnd {
        return new ValidatorLogicAnd(...$validations);
    }
}
