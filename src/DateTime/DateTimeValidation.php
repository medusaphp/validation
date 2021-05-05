<?php declare(strict_types = 1);
namespace Medusa\Validation\DateTime;

use Medusa\Validation\Date\DateValidation;
use Medusa\Validation\Date\DateValidationInterface;
use Medusa\Validation\Exception\ValidationException;
use Medusa\Validation\Result\InvalidResult;
use Medusa\Validation\Result\ResultInterface;
use Medusa\Validation\Result\ValidResult;
use Medusa\Validation\StringValidation;
use Medusa\Validation\Time\Iso8601HMSValidation;
use Medusa\Validation\Time\TimeValidationInterface;
use Medusa\Validation\ValidationAbstract;

/**
 * Class DateTimeValidation
 * @package medusa/validation
 * @author Anton Zoffmann <anton.zoffmann@getmedusa.org>
 */
class DateTimeValidation extends ValidationAbstract {

    private DateValidationInterface $dateValidation;

    private TimeValidationInterface $timeValidation;

    /**
     * DateTimeValidation constructor.
     * @param DateValidationInterface $date
     * @param TimeValidationInterface $time
     */
    public function __construct(DateValidationInterface $date, TimeValidationInterface $time) {
        $this->dateValidation = $date;
        $this->timeValidation = $time;
    }

    /**
     * @param bool $strict
     * @param bool $withSeparator
     * @return DateTimeValidation
     */
    public static function createDefault(bool $strict = false, bool $withSeparator = true): DateTimeValidation {
        return new static(new DateValidation($strict), new Iso8601HMSValidation($withSeparator));
    }

    /**
     * @return StringValidation[]
     */
    public function dependsOn(): array {
        return [
            new StringValidation(),
        ];
    }

    /**
     * @param mixed $value
     * @csIgnoreParamType $value could be anything
     * @return ResultInterface
     * @throws ValidationException
     */
    protected function doValidation($value): ResultInterface {
        $parts = explode(' ', $value);
        if (count($parts) < 2) {
            return new InvalidResult($value, 'date and time parts needed');
        }
        if (count($parts) > 2) {
            return new InvalidResult($value, 'invalid number of tokens');
        }
        if (!($dateResult = $this->dateValidation->validate($parts[0]))->isValid()) {
            return $dateResult;
        }
        if (!($timeResult = $this->timeValidation->validate($parts[1]))->isValid()) {
            return $timeResult;
        }
        return new ValidResult(implode(' ', [$dateResult->getValue(), $timeResult->getValue()]));
    }
}
