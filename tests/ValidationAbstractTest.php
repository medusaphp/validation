<?php declare(strict_types = 1);
namespace Medusa\Validation\Tests;

use Medusa\Validation\Result\InvalidResult;
use Medusa\Validation\Result\ResultInterface;
use Medusa\Validation\Result\ValidResult;
use Medusa\Validation\ValidationAbstract;
use Medusa\Validation\ValidationInterface;
use PHPUnit\Framework\TestCase;

class ValidationAbstractTest extends TestCase {

    /**
     * test that abstract doValidation is called through validate
     * @return void
     */
    public function testValidationCall() {
        $testStub = new class extends ValidationAbstract {
            public $calledDoValidation = false;
            public function dependsOn(): array {
                return [];
            }
            protected function doValidation($value): ResultInterface {
                $this->calledDoValidation = true;
                return new ValidResult(null);
            }
        };

        $testStub->validate(null);

        $this->assertTrue($testStub->calledDoValidation);
    }

    public function testInvalidDependencyEarlyReturn() {
        $dependency = $this->getMockForAbstractClass(ValidationInterface::class);
        $precondition = new InvalidResult(null);
        $dependency->method('validate')->willReturn($precondition);
        $testStub = new class ($dependency) extends ValidationAbstract {
            public $calledDoValidation = false;
            private ValidationInterface $dependency;
            public function __construct(ValidationInterface $dependency) {
                $this->dependency = $dependency;
            }
            public function dependsOn(): array {
                return [
                    $this->dependency,
                ];
            }
            protected function doValidation($value): ResultInterface {
                $this->calledDoValidation = true;
                return new ValidResult(null);
            }
        };

        $res = $testStub->validate(null);

        $this->assertFalse($testStub->calledDoValidation);
        $this->assertSame($precondition, $res);
    }
}