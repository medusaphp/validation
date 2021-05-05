<?php //declare(strict_types = 1);
namespace Medusa\Validation\Tests\Comparison;

use Medusa\Validation\Comparison\GreaterThanValidation;
use Medusa\Validation\Tests\SimpleTestAbstract;

class GreaterThanValidationTest extends SimpleTestAbstract {

    public function provideData(): array {
        return [
            'not greater integer' => [new GreaterThanValidation(1), false, 0],
            'greater integer' => [new GreaterThanValidation(1), true, 2],
            'equal integer' => [new GreaterThanValidation(1), false, 1],
            'not greater float' => [new GreaterThanValidation(1.0), false, 0.0],
            'greater float' => [new GreaterThanValidation(1.0), true, 2.0],
            'equal float' => [new GreaterThanValidation(1.0), false, 1.0],
        ];
    }
}