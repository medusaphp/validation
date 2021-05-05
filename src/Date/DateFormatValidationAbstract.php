<?php declare(strict_types = 1);
namespace Medusa\Validation\Date;

use DateTime;
use Medusa\Validation\Exception\ValidationException;
use Medusa\Validation\Result\InvalidResult;
use Medusa\Validation\Result\ResultInterface;
use Medusa\Validation\Result\ValidResult;
use Medusa\Validation\StringValidation;
use Medusa\Validation\ValidationAbstract;
use function ltrim;
use function preg_replace;

/**
 * Class DateFormatValidationAbstract
 * @package medusa/validation
 * @author  Anton Zoffmann <anton.zoffmann@getmedusa.org>
 */
abstract class DateFormatValidationAbstract extends ValidationAbstract implements DateValidationInterface {

    private bool $strict;

    /**
     * @return string
     */
    abstract public function getFormat(): string;

    /**
     * DateFormatValidationAbstract constructor.
     * @param bool $strict
     */
    public function __construct(bool $strict = false) {
        $this->strict = $strict;
    }

    /**
     * @return StringValidation[]
     */
    public function dependsOn(): array {
        return [
            new StringValidation(true),
        ];
    }

    /**
     * @param mixed $value
     * @csIgnoreParamType $value could be anything
     * @return ResultInterface
     * @throws ValidationException
     */
    protected function doValidation($value): ResultInterface {

        $valueWithoutLeadingZeros = preg_replace('/(?<=[^0-9])0*/', '', ltrim($value, '0'));
        $date = DateTime::createFromFormat($this->getFormat(), $value);

        if ($date === false) {
            return new InvalidResult($value, 'incorrect date format');
        }

        $formatted = $date->format($this->getFormat());
        $dateWithoutLeadingZeros = preg_replace('/(?<=[^0-9])0*/', '', ltrim($formatted, '0'));

        if ($dateWithoutLeadingZeros !== $valueWithoutLeadingZeros) {
            return new InvalidResult($value, 'invalid date');
        }

        if (!$date) {
            return new InvalidResult($value, 'invalid date format');
        }

        // use string value as return because it contains exactly provided amount of information.
        // DateTime Object would add magic data as Point of Time or TimeZone which is unwanted.
        if ($this->strict && $value !== $formatted) {
            return new InvalidResult($value, 'incorrect date format (strictmode=on)');
        }

        return new ValidResult($formatted);
    }
}
