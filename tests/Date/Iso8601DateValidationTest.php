<?php declare(strict_types = 1);
namespace Medusa\Validation\Tests\Date;

use Medusa\Validation\Date\Iso8601DateValidation;
use Medusa\Validation\Tests\SimpleTestAbstract;

class Iso8601DateValidationTest extends SimpleTestAbstract {

    public function provideData(): iterable {
        return [
            'german date' => [new Iso8601DateValidation(false), false, '31.12.2021', '31.12.2021'],
            'american date 1' => [new Iso8601DateValidation(false), false, '12/31/2021', '12/31/2021'],
            'american date 2' => [new Iso8601DateValidation(false), false, '1/1/2021', '1/1/2021'],
            'ISO 8601 JJJJ-MM-TT' => [new Iso8601DateValidation(false), true, '2021-05-03', '2021-05-03'],
            'ISO 8601 missing day and month digit' => [new Iso8601DateValidation(false), true, '2021-5-3', '2021-05-03'],
            'ISO 8601 missing day digit' => [new Iso8601DateValidation(false), true, '2021-05-3', '2021-05-03'],
            'ISO 8601 missing day digit strict' => [new Iso8601DateValidation(true), false, '2021-05-3', '2021-05-3'],
            'ISO 8601 missing month digit' => [new Iso8601DateValidation(false), true, '2021-5-03', '2021-05-03'],
            'ISO 8601 missing month digit strict' => [new Iso8601DateValidation(true), false, '2021-5-03', '2021-5-03'],
            'ISO 8601 missing year digits' => [new Iso8601DateValidation(false), true, '21-05-03', '0021-05-03'],    // you would expect 2021? fine, this is just about validation and not assuming a century.
            'ISO 8601 missing year digits strict' => [new Iso8601DateValidation(true), false, '21-05-03', '21-05-03'],
        ];
    }
}
