<?php declare(strict_types = 1);
namespace Medusa\Validation\Tests;

use Medusa\Validation\UrlValidation;

class UrlValidationTest extends SimpleTestAbstract {

    public function provideData(): array {
        return [
            'scheme://host' => [new UrlValidation(), true, 'https://getmedusa.org'],
            'plaintext'     => [new UrlValidation(), false, 'get medusa '],
            'umlaut host'   => [new UrlValidation(), true, 'https://www.wäit.os'],
            'host/path'     => [new UrlValidation(), true, '//getmedusa.org/foo/bar/'],
        ];
    }
}
