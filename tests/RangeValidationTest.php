<?php declare(strict_types = 1);
namespace Medusa\Validation\Tests;

use Medusa\Validation\RangeValidation;

class RangeValidationTest extends SimpleTestAbstract {

    public function provideData(): array {

        return [
            [new RangeValidation(4, 6), true, 4,],
            [new RangeValidation(4, 6), true, 6,],
            [new RangeValidation(4, 5), false, 6,],
            [new RangeValidation(4, 5), false, 2,],
            [new RangeValidation('2000-01-02'), false, '2000-01-01',],
            [new RangeValidation('2000-01-02'), true, '2000-01-03',],
            [new RangeValidation(null, '2000-01-02'), false, '2000-01-03',],
            [new RangeValidation(null, '2000-01-02'), true, '2000-01-01',],
            [new RangeValidation('a', 'c'), true, 'a',],
            [new RangeValidation('a', 'c'), true, 'b',],
            [new RangeValidation('a', 'c'), true, 'c',],
            [new RangeValidation('a', 'c'), false, 'd',],
            [new RangeValidation('a', 'c'), false, 'A',],
            [new RangeValidation('a', 'c'), false, 'B',],
            [new RangeValidation('a', 'c'), false, 'C',],
        ];
    }
}
