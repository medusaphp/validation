<?php declare(strict_types = 1);
namespace Validator;

use Medusa\Validation\ArrayValidation\ArrayValidation;
use Medusa\Validation\IntegerValidation;
use Medusa\Validation\LengthValidation;
use Medusa\Validation\RangeValidation;
use Medusa\Validation\StringValidation;
use Medusa\Validation\Tests\SimpleTestAbstract;
use Medusa\Validation\Validator\ValidatorLogicAnd;
use Medusa\Validation\Validator\ValidatorLogicOr;

class ValidatorTest extends SimpleTestAbstract {

    public function provideData(): iterable {

        return [
            [new ValidatorLogicAnd(new IntegerValidation(true), new RangeValidation(1, 3)), true, 1],
            [new ValidatorLogicAnd(new IntegerValidation(true), new RangeValidation(1, 3)), false, 4],
            [new ValidatorLogicOr(new IntegerValidation(true), new ArrayValidation()), true, 4],
            [new ValidatorLogicOr(new IntegerValidation(true), new ArrayValidation()), true, []],
            [new ValidatorLogicOr(new IntegerValidation(true), new ArrayValidation()), false, '4'],
            [new ValidatorLogicAnd(
                 new ValidatorLogicOr(
                     new StringValidation(true),
                     new ArrayValidation()
                 ),
                 new LengthValidation(4)
             ), false, 'a'],
            [new ValidatorLogicAnd(
                 new ValidatorLogicOr(
                     new StringValidation(true),
                     new ArrayValidation()
                 ),
                 new LengthValidation(4)
             ), true, 'abcd'],
            [new ValidatorLogicAnd(
                 new ValidatorLogicOr(
                     new StringValidation(true),
                     new ArrayValidation()
                 ),
                 new LengthValidation(4)
             ), false, [0]],
            [new ValidatorLogicAnd(
                 new ValidatorLogicOr(
                     new StringValidation(true),
                     new ArrayValidation()
                 ),
                 new LengthValidation(4)
             ), true, [0, 1, 2, 3]],
        ];
    }
}
