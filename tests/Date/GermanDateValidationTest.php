<?php declare(strict_types = 1);
namespace Medusa\Validation\Tests\Date;

use Medusa\Validation\Date\GermanDateValidation;
use Medusa\Validation\Tests\SimpleTestAbstract;

class GermanDateValidationTest extends SimpleTestAbstract {

    public function provideData(): iterable {
        return [
            'german date' => [new GermanDateValidation(false), true, '31.12.2021', '31.12.2021'],
            'german date missing day digit' => [new GermanDateValidation(false), true, '1.12.2021', '01.12.2021'],
            'german date missing day digit strict' => [new GermanDateValidation(true), false, '1.12.2021', '1.12.2021'],
            'german date missing month digit' => [new GermanDateValidation(false), true, '01.2.2021', '01.02.2021'],
            'german date missing month digit strict' => [new GermanDateValidation(true), false, '01.2.2021', '01.2.2021'],
            'german date missing year digit' => [new GermanDateValidation(false), true, '01.02.90', '01.02.0090'],
            'german date missing year digit strict' => [new GermanDateValidation(true), false, '01.02.90', '01.02.90'],
            'german date day out of bounds' => [new GermanDateValidation(false), false, '32.02.1990', '32.02.1990'],
            'german date day out of bounds strict' => [new GermanDateValidation(true), false, '32.02.1990', '32.02.1990'],
            'german date month of bounds' => [new GermanDateValidation(false), false, '31.13.1990', '31.13.1990'],
            'german date month out of bounds strict' => [new GermanDateValidation(true), false, '31.13.1990', '31.13.1990'],

            'american date 1' => [new GermanDateValidation(false), false, '12/31/2021', '12/31/2021'],
            'american date 2' => [new GermanDateValidation(false), false, '1/1/2021', '1/1/2021'],

            'ISO 8601 JJJJ-MM-TT' => [new GermanDateValidation(false), false, '2021-05-03', '2021-05-03'],
            'ISO 8601 JJJJ-MM-TT strict' => [new GermanDateValidation(true), false, '2021-05-03', '2021-05-03'],
        ];
    }
}