<?php declare(strict_types = 1);
namespace Medusa\Validation\Tests;

use Medusa\Validation\IntegerValidation;

class IntegerValidationTest extends SimpleTestAbstract {

    public function provideData(): array {
        return [
            [new IntegerValidation(false), true, '1',],
            [new IntegerValidation(false), false, '1.0',],
            [new IntegerValidation(true), false, '1',],
            [new IntegerValidation(true), false, 1.0,],
            [new IntegerValidation(true), true, 1,],
            [new IntegerValidation(true), false, '1a',],
            [new IntegerValidation(true), false, 'hallo',],
        ];
    }
}
