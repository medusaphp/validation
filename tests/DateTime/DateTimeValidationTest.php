<?php declare(strict_types = 1);
namespace Medusa\Validation\Tests\DateTime;

use Medusa\Validation\DateTime\DateTimeValidation;
use Medusa\Validation\Tests\SimpleTestAbstract;

class DateTimeValidationTest extends SimpleTestAbstract {

    public function provideData(): array {
        return [
            'german datetime' => [DateTimeValidation::createDefault(true, true), true, '01.01.2021 12:12:12'],
            'iso8601 datetime' => [DateTimeValidation::createDefault(true, true), true, '2021-01-01 12:12:12'],
        ];
    }
}
