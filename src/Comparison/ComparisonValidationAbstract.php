<?php declare(strict_types = 1);
namespace Medusa\Validation\Comparison;

use Medusa\Validation\Exception\ValidationException;
use Medusa\Validation\Result\InvalidResult;
use Medusa\Validation\Result\ResultInterface;
use Medusa\Validation\Result\ValidResult;
use Medusa\Validation\ValidationAbstract;

/**
 * Class GreaterThan
 * @package medusa/validation
 * @author  Pascal Schnell <pascal.schnell@getmedusa.org>
 */
abstract class ComparisonValidationAbstract extends ValidationAbstract {

    /** @var mixed */
    private $comparisonValue;

    /**
     * @param mixed $a
     * @csIgnoreParamType $a could be anything
     * @param mixed $b
     * @csIgnoreParamType $b could be anything
     * @return string|null
     */
    abstract protected function compare($a, $b): ?string;

    /**
     * ComparisonValidationAbstract constructor.
     * @param mixed $comparisonValue
     * @csIgnoreParamType $comparisonValue could be anything
     */
    public function __construct($comparisonValue) {
        $this->comparisonValue = $comparisonValue;
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
     * @throws ValidationException
     */
    protected function doValidation($value): ResultInterface {

        $res = $this->compare($value, $this->comparisonValue);

        if ($res) {
            return new InvalidResult($value, $res);
        }

        return new ValidResult($value);
    }
}
