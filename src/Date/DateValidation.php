<?php declare(strict_types = 1);
namespace Medusa\Validation\Date;

use DateTime;
use Medusa\Validation\Exception\ValidationException;
use Medusa\Validation\Result\InvalidResult;
use Medusa\Validation\Result\ResultInterface;
use Medusa\Validation\Result\ValidResult;
use Medusa\Validation\StringValidation;
use Medusa\Validation\ValidationAbstract;

/**
 * Class DateValidation
 * @package medusa/validation
 * @author Anton Zoffmann <anton.zoffmann@getmedusa.org>
 */
class DateValidation extends ValidationAbstract implements DateValidationInterface {

    private array  $stack;

    private DateFormatValidationAbstract $formatProvider;

    /**
     * DateValidation constructor.
     * @param bool $strict
     */
    public function __construct(bool $strict = false) {
        $this->stack[] = $this->formatProvider = new Iso8601DateValidation($strict);
        $this->stack[] = new GermanDateValidation($strict);
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

        foreach ($this->stack as $impl) {
            if (($res = $impl->validate($value))->isValid()) {
                return new ValidResult((DateTime::createFromFormat($impl->getFormat(), $res->getValue()))->format($this->formatProvider->getFormat()));
            }
        }

        return new InvalidResult($value, 'Date could not be validated with formats ("' . implode('","', array_map(fn(DateFormatValidationAbstract $d) => $d->getFormat(), $this->stack)) . '")');
    }
}
