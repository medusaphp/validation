<?php declare(strict_types = 1);
namespace Medusa\Validation\Tests;

use Medusa\Validation\LengthValidation;
use Medusa\Validation\ValidationInterface;
use TypeError;

class LengthValidationTest extends SimpleTestAbstract {

    public function provideData(): array {
        return [
            [new LengthValidation(4, 6), true, 'abcd',],
            [new LengthValidation(4, 6), false, 'abcdefg',],
            [new LengthValidation(5, 6), false, 'abcd',],
            [new LengthValidation(4), false, ['a', 'b', 'c'],],
            [new LengthValidation(1), true, ['a', 'b', 'c'],],
            [new LengthValidation(null, 1), false, ['a', 'b', 'c'],],
            [new LengthValidation(null, 3), true, ['a', 'b', 'c'],],
        ];
    }

    public function provideDataForExceptionTesting(): array {
        return [
            [new LengthValidation(), 1, TypeError::class, 'mb_strlen()'],
        ];
    }

    /**
     * @dataProvider provideDataForExceptionTesting
     */
    public function testExceptions(ValidationInterface $validation, $data, string $expectedException, ?string $exceptionMessage = null) {
        $this->expectException($expectedException);

        if ($exceptionMessage !== null) {
            $this->expectExceptionMessage($exceptionMessage);
        }

        $validation->validate($data);
    }
}
