<?php declare(strict_types = 1);
namespace Medusa\Validation\Tests\Date;

use Medusa\Validation\Date\DateValidation;
use Medusa\Validation\Tests\SimpleTestAbstract;

class DateValidationTest extends SimpleTestAbstract {

    public function provideData(): iterable {
        return [
            'german date' => [new DateValidation(false), true, '31.12.2021', '2021-12-31'],
            'german date strict' => [new DateValidation(true), true, '31.12.2021', '2021-12-31'],
            'german date missing day digit' => [new DateValidation(false), true, '1.12.2021', '2021-12-01'],
            'german date missing day digit strict' => [new DateValidation(true), false, '1.12.2021', '1.12.2021'],
            'german date missing month digit' => [new DateValidation(false), true, '01.2.2021', '2021-02-01'],
            'german date missing month digit strict' => [new DateValidation(true), false, '01.2.2021', '01.2.2021'],
            'german date missing year digit' => [new DateValidation(false), true, '01.02.90', '0090-02-01'],
            'german date missing year digit strict' => [new DateValidation(true), false, '01.02.90', '01.02.90'],

            'american date 1' => [new DateValidation(false), false, '12/13/2021', '12/13/2021'],
            'american date 2' => [new DateValidation(false), false, '1/1/2021', '1/1/2021'],

            'ISO 8601 JJJJ-MM-TT' => [new DateValidation(false), true, '2021-05-03', '2021-05-03'],
            'ISO 8601 missing day digit' => [new DateValidation(false), true, '2021-05-3', '2021-05-03'],
            'ISO 8601 missing day digit strict' => [new DateValidation(true), false, '2021-05-3', '2021-05-3'],
            'ISO 8601 missing month digit' => [new DateValidation(false), true, '2021-5-03', '2021-05-03'],
            'ISO 8601 missing month digit strict' => [new DateValidation(true), false, '2021-5-03', '2021-5-03'],
            'ISO 8601 missing year digits' => [new DateValidation(false), true, '21-05-03', '0021-05-03'],
            'ISO 8601 missing year digits strict' => [new DateValidation(true), false, '21-05-03', '21-05-03'],
        ];
    }
}
