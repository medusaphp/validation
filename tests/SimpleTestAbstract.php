<?php declare(strict_types = 1);
namespace Medusa\Validation\Tests;

use Medusa\Validation\ValidationInterface;
use PHPUnit\Framework\TestCase;
use function func_get_arg;
use function func_num_args;


abstract class SimpleTestAbstract extends TestCase {

    abstract public function provideData(): iterable;

    /**
     * @param bool $expectation
     * @param      $data
     * @return void
     * @dataProvider provideData
     */
    public function testValidation(ValidationInterface $validation, bool $expectation, $data) {

        $formattedValue = null;
        $formattedValueExists = false;
        if (func_num_args() > 3) {
            $formattedValue = func_get_arg(3);
            $formattedValueExists = true;
        }

        $result = $validation->validate($data);

        $this->assertEquals($expectation, $result->isValid());

        if ($formattedValueExists) {
            $this->assertEquals($formattedValue, $result->getValue());
        }
    }
}
