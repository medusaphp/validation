<?php declare(strict_types = 1);
namespace Medusa\Validation\Comparison;

/**
 * Class LowerThan
 * @package medusa/validation
 * @author  Pascal Schnell <pascal.schnell@getmedusa.org>
 */
class LowerThanValidation extends ComparisonValidationAbstract {

    /**
     * @param mixed $value
     * @csIgnoreParamType $value could be anything
     * @param mixed $comparisonValue
     * @csIgnoreParamType $comparisonValue could be anything
     * @return string|null
     */
    protected function compare($value, $comparisonValue): ?string {
        if ($value >= $comparisonValue) {
            return 'value is greater or equal than ' . $comparisonValue;
        }
        return null;
    }
}
