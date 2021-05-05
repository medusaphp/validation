<?php declare(strict_types = 1);
namespace Medusa\Validation\Time;

use Medusa\Validation\Exception\ValidationException;
use Medusa\Validation\Result\InvalidResult;
use Medusa\Validation\Result\ResultInterface;
use Medusa\Validation\Result\ValidResult;
use Medusa\Validation\StringValidation;
use Medusa\Validation\ValidationAbstract;

/**
 * @package medusa/validation
 * @author Anton Zoffmann <anton.zoffmann@getmedusa.org>
 */
abstract class Iso8601TimeValidationAbstract extends ValidationAbstract implements TimeValidationInterface {

    private bool $withSeparator;

    public const HOURS_ONLY = 0;

    public const SHOW_MINUTES = 1;

    public const SHOW_SECONDS = 2;

    private int $config;

    /**
     * Iso8601TimeValidationAbstract constructor.
     * @param bool $withSeparator
     * @param int  $config
     * @throws ValidationException
     */
    public function __construct(bool $withSeparator, int $config = self::SHOW_MINUTES | self::SHOW_SECONDS) {
        $this->withSeparator = $withSeparator;
        $this->validateConfig($config);
        $this->config = $config;
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
        $format = [];
        $format[] = 'H';

        if ($this->config & self::SHOW_MINUTES) {
            $format[] = 'i';
        }

        if ($this->config & self::SHOW_SECONDS) {
            $format[] = 's';
        }
        $fmt = implode($this->withSeparator ? ':' : '', $format);

        if (!$datetime = \DateTime::createFromFormat($fmt, $value)) {
            return new InvalidResult(null, 'timeformat "' . $fmt . '" cannot be parsed');
        }
        return new ValidResult($datetime->format($fmt));
    }

    /**
     * @param int $config
     * @return void
     * @throws ValidationException
     */
    private function validateConfig(int $config): void {
        if ($config & self::SHOW_MINUTES) {
            return;
        }
        if ($config & self::SHOW_SECONDS) {
            throw new ValidationException('invalid config of ' . __CLASS__ . ' -> seconds cannot be shown without minutes.');
        }
    }
}
