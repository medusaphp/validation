<?php declare(strict_types = 1);
namespace Medusa\Validation\Result;

/**
 * Class ValidResult
 * @package medusa/validation
 * @author  Pascal Schnell <pascal.schnell@getmedusa.org>
 */
class ValidResult implements ResultInterface {

    private string $reason;

    /** @var mixed */
    private $value;

    /**
     * ValidResult constructor.
     * @param mixed  $value
     * @param string $reason
     * @csIgnoreParamType $value could be anything
     */
    public function __construct($value, string $reason = '') {
        $this->value = $value;
        $this->reason = $reason;
    }

    /**
     * @return int
     */
    public function getReturnCode(): int {
        return 0;
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
        return true;
    }

    /**
     * @return string
     */
    public function getReason(): string {
        return $this->reason;
    }
}
