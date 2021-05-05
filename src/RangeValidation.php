<?php declare(strict_types = 1);
namespace Medusa\Validation;

use Medusa\Validation\Result\InvalidResult;
use Medusa\Validation\Result\ResultInterface;
use Medusa\Validation\Result\ValidResult;
use function sprintf;

/**
 * Class RangeValidation
 * @package medusa/validation
 * @author  Pascal Schnell <pascal.schnell@getmedusa.org>
 */
class RangeValidation extends ValidationAbstract {

    /** @var mixed  */
    private $max;

    /** @var mixed  */
    private $min;

    /**
     * RangeValidation constructor.
     * @param string|array|countable|null $min
     * @param string|array|countable|null $max
     */
    public function __construct($min = null, $max = null) {
        $this->min = $min;
        $this->max = $max;
    }

    /**
     * @return array
     */
    public function dependsOn(): array {
        return [];
    }

    /**
     * @param string|array|countable $value
     * @return ResultInterface
     */
    protected function doValidation($value): ResultInterface {

        if ($this->min !== null && $value < $this->min) {
            return new InvalidResult($value, sprintf('argument out of range - min(%s)', $this->min));
        }

        if ($this->max !== null && $value > $this->max) {
            return new InvalidResult($value, sprintf('argument out of range - max(%s)', $this->max));
        }

        return new ValidResult($value);
    }
}
