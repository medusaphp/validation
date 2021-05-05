<?php declare(strict_types = 1);
namespace Medusa\Validation\ArrayValidation;

use Medusa\Validation\Exception\ValidationException;
use Medusa\Validation\Result\InvalidResult;
use Medusa\Validation\Result\ResultInterface;
use Medusa\Validation\Result\ValidResult;
use Medusa\Validation\ValidationAbstract;
use function implode;
use function in_array;

/**
 * Class InArrayValidation
 * @package medusa/validation
 * @author  Pascal Schnell <pascal.schnell@getmedusa.org>
 */
class InArrayValidation extends ValidationAbstract {

    private array $allowedValues;
    private bool  $strict;
    private bool  $multiValues;

    /**
     * InArrayValidation constructor.
     * @param array $allowedValues
     * @param bool  $strict
     * @param bool  $multiValues
     */
    public function __construct(array $allowedValues, bool $strict = true, bool $multiValues = false) {
        $this->allowedValues = $allowedValues;
        $this->strict = $strict;
        $this->multiValues = $multiValues;
    }

    /**
     * @return array|ArrayValidation[]
     */
    public function dependsOn(): array {

        if ($this->multiValues) {
            return [
                new ArrayValidation(),
            ];
        }
        return [];
    }

    /**
     * @param mixed $value
     * @csIgnoreParamType $value could be anything
     * @return ResultInterface
     * @throws ValidationException
     */
    protected function doValidation($value): ResultInterface {

        if ($this->multiValues) {
            $values = $value;
        } else {
            $values = [$value];
        }

        foreach ($values as $value) {

            if (!in_array($value, $this->allowedValues, $this->strict)) {
                return new InvalidResult($this->multiValues ? $values : $value, 'value must be "' . implode(',', $this->allowedValues) . '"');
            }
        }

        return new ValidResult($this->multiValues ? $values : $value);
    }
}
