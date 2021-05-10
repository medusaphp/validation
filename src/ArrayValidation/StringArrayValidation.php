<?php declare(strict_types = 1);
namespace Medusa\Validation\ArrayValidation;

use Medusa\Validation\Exception\ValidationException;
use Medusa\Validation\IntegerValidation;
use Medusa\Validation\Result\ResultInterface;
use Medusa\Validation\Result\ValidResult;
use Medusa\Validation\StringValidation;
use Medusa\Validation\ValidationAbstract;

/**
 * Class StringArrayValidation
 * @package medusa/validation
 * @author  Pascal Schnell <pascal.schnell@getmedusa.org>
 */
class StringArrayValidation extends ValidationAbstract {

    private bool $strict;

    /**
     * IntArrayValidation constructor.
     * @param bool $strict
     */
    public function __construct(bool $strict = true) {
        $this->strict = $strict;
    }

    /**
     * @return ArrayValidation[]
     */
    public function dependsOn(): array {
        return [
            new ArrayValidation(),
        ];
    }

    /**
     * @param mixed $value
     * @csIgnoreParamType $value could be anything
     * @return ResultInterface
     * @throws ValidationException
     */
    protected function doValidation($value): ResultInterface {

        $validation = new StringValidation($this->strict);
        foreach ($value as &$item) {
            $result = $validation->validate($item);

            if (!$result->isValid()) {
                return $result;
            }

            $item = $result->getValue();
        }

        unset($item);

        return new ValidResult($value);
    }
}
