<?php declare(strict_types = 1);
namespace Medusa\Validation\Result;

use Medusa\Validation\Exception\ValidationException;

/**
 * Class InvalidResult
 * @package medusa/validation
 * @author  Pascal Schnell <pascal.schnell@getmedusa.org>
 */
class InvalidResult implements ResultInterface {

    private string $reason;

    /** @var mixed */
    private $value;

    private int $returnCode;

    /**
     * InvalidResult constructor.
     * @param mixed  $value
     * @csIgnoreParamType $value could be anything
     * @param string $reason
     * @param int    $returnCode
     * @throws ValidationException
     */
    public function __construct($value, string $reason = '', int $returnCode = 1) {

        if ($returnCode === 0) {
            throw new ValidationException('An returncode for an invalid result must be not equal to 0');
        }

        $this->value = $value;
        $this->reason = $reason;
        $this->returnCode = $returnCode;
    }

    /**
     * @return int
     */
    public function getReturnCode(): int {
        return $this->returnCode;
    }

    /**
     * @return mixed
     * @csIgnoreMixedReturn because could be anything
     */
    public function getValue() {
        return $this->value;
    }

    /**
     * @return bool
     */
    public function isValid(): bool {
        return false;
    }

    /**
     * @return string
     */
    public function getReason(): string {
        return $this->reason;
    }
}
