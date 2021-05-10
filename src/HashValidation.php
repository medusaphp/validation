<?php declare(strict_types = 1);
namespace Medusa\Validation;

use Medusa\Validation\Result\InvalidResult;
use Medusa\Validation\Result\ResultInterface;
use Medusa\Validation\Result\ValidResult;
use function preg_match;

/**
 * Class HashValidation
 * @package medusa/validation
 * @author  Pascal Schnell <pascal.schnell@getmedusa.org>
 */
class HashValidation implements ValidationInterface {

    private int $length;

    /**
     * HashValidation constructor.
     * @param int $length
     */
    public function __construct(int $length) {
        $this->length = $length;
    }

    /**
     * @return ValidationInterface[]
     */
    public function dependsOn(): array {
        return [
            new StringValidation(false),
        ];
    }

    /**
     * @param mixed $value
     * @csIgnoreParamType $value could be anything
     * @return ResultInterface
     * @throws Exception\ValidationException
     */
    public function validate($value): ResultInterface {
        $pattern = '/^[a-f0-9]{' . $this->length . '}$/i';

        if (!preg_match($pattern, $value)) {
            return new InvalidResult($value, 'no valid hash (length: ' . $this->length . ')');
        }

        return new ValidResult($value);
    }
}
