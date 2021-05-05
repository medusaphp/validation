<?php declare(strict_types = 1);
namespace Medusa\Validation\Tests\Time;

use Medusa\Validation\Tests\SimpleTestAbstract;
use Medusa\Validation\Time\Iso8601HMSValidation;

class Iso8601HMSValidationTest extends SimpleTestAbstract {

    public function provideData(): array {
        return [
            'hh:mm:ss' => [new Iso8601HMSValidation(true), true, '16:43:16'],
            'hhmmss' => [new Iso8601HMSValidation(false), true, '164316'],
            'hh:mm' => [new Iso8601HMSValidation(true), false, '16:43'],
            'hhmm' => [new Iso8601HMSValidation(false), false, '1643'],
            'hh' => [new Iso8601HMSValidation(true), false, '16'],
            'hh - wo Separator' => [new Iso8601HMSValidation(false), false, '16'],
        ];
    }
}
