<?php declare(strict_types = 1);
namespace Medusa\Validation;

use Medusa\Validation\Result\InvalidResult;
use Medusa\Validation\Result\ResultInterface;
use Medusa\Validation\Result\ValidResult;
use function count;
use function is_countable;
use function is_scalar;
use function is_string;
use function mb_strlen;
use function sprintf;

/**
 * @package medusa/validation
 * @author  Pascal Schnell <pascal.schnell@getmedusa.org>
 */
class LengthValidation extends ValidationAbstract {

    private ?int $max;
    private ?int $min;

    /**
     * LengthValidation constructor.
     * @param int|null $min
     * @param int|null $max
     */
    public function __construct(?int $min = null, ?int $max = null) {
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

        if (is_countable($value)) {
            $length = count($value);
        } else {

            if (!is_string($value) && is_scalar($value)) {
                $value = (string) $value;
            }
            $length = mb_strlen($value);
        }

        if ($this->min !== null && $length < $this->min) {
            return new InvalidResult($value, sprintf('min length(%s)', $this->min));
        }

        if ($this->max !== null && $length > $this->max) {
            return new InvalidResult($value, sprintf('max length(%s)', $this->max));
        }

        return new ValidResult($value);
    }
}
