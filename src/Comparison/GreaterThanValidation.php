<?php declare(strict_types = 1);
namespace Medusa\Validation\Comparison;

/**
 * Class GreaterThan
 * @package medusa/validation
 * @author  Pascal Schnell <pascal.schnell@getmedusa.org>
 */
class GreaterThanValidation extends ComparisonValidationAbstract {

    /**
     * @param mixed $value
     * @csIgnoreParamType $value could be anything
     * @param mixed $comparisonValue
     * @csIgnoreParamType $comparisonValue could be anything
     * @return string|null
     */
    protected function compare($value, $comparisonValue): ?string {
        if ($value <= $comparisonValue) {
            return 'value is lower or equal than ' . $comparisonValue;
        }
        return null;
    }
}
