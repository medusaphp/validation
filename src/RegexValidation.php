<?php declare(strict_types = 1);

namespace Medusa\Validation;

use Medusa\Validation\Result\InvalidResult;
use Medusa\Validation\Result\ResultInterface;
use Medusa\Validation\Result\ValidResult;
use function Medusa\DevTools\d;
use function Medusa\DevTools\dd;
use function sprintf;

/**
 * Class RegexValidation
 * @package Medusa\Validation
 * @author  Pascale Schnell <pascale.schnell@check24.de>
 */
class RegexValidation extends ValidationAbstract {

    private string $pattern;
    private bool   $resultIsValidOnMatch;

    public function __construct(string $pattern, bool $resultIsValidOnMatch = true) {
        $this->pattern = $pattern;
        $this->resultIsValidOnMatch = $resultIsValidOnMatch;
    }

    public function dependsOn(): array {
        return [
            new StringValidation(false),
        ];
    }

    protected function doValidation($value): ResultInterface {

        $match = preg_match($this->pattern, $value) === 1;

        if ($match === $this->resultIsValidOnMatch) {
            return new ValidResult($value);
        }

        $msg = $this->resultIsValidOnMatch ? 'Value must match pattern "%s"' : 'Value must not match pattern "%s"';

        return new InvalidResult($value, sprintf($msg, $this->pattern));
    }
}
