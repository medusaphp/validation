<?php declare(strict_types = 1);
namespace Medusa\Validation\Tests;

use Medusa\Validation\EmailValidation;
use PHPUnit\Framework\TestCase;

class EmailValidationTest extends SimpleTestAbstract {

    public function provideData(): array {
        $result = [
            'test-mail' => [new EmailValidation(), true, 'max.mustermann@getmedusa.org'],
            'dont start with a dot' => [new EmailValidation(), false, '.max.mustermann@getmedusa.org'],
            'dont contain a ".."' => [new EmailValidation(), false, '.max..mustermann@getmedusa.org'],
            'local part shall not end with dot' => [new EmailValidation(), false, 'max.mustermann.@getmedusa.org'],
        ];
        $specialChars = 'àáâãäåæçèéêëìíîïðñòóôõöøùúûüýþÿāăąćĉċčďđēĕėęěĝğġģĥħĩīĭįıĵķĸĺļľłńņňŋōŏőœŕŗřśŝşšßţťŧũūŭůűųŵŷźżž';
        foreach (mb_str_split($specialChars, 1) as $specialChar) {
            $result['special char "' . $specialChar . '" in domain'] = [new EmailValidation(), true, 'foo@b' . $specialChar . 'r.de'];
        }
        return $result;
    }
}
