<?php declare(strict_types = 1);
namespace Medusa\Validation\Tests\Comparison;

use Medusa\Validation\Comparison\LowerThanValidation;
use Medusa\Validation\Tests\SimpleTestAbstract;

class LowerThanValidationTest extends SimpleTestAbstract {

    public function provideData(): array {
        return [
            'greater integer' => [new LowerThanValidation(1), false, 2],
            'lower integer' => [new LowerThanValidation(1), true, 0],
            'equal integer' => [new LowerThanValidation(1), false, 1],
            'greater float' => [new LowerThanValidation(1.0), false, 1.1],
            'lower float' => [new LowerThanValidation(1.0), true, 0.1],
            'equal float' => [new LowerThanValidation(1.0), false, 1.0],
        ];
    }
}