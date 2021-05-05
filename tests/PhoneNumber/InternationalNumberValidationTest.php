<?php declare(strict_types = 1);
namespace Medusa\Validation\Tests\PhoneNumber;

use Medusa\Validation\PhoneNumber\InternationalNumberValidation;
use Medusa\Validation\Tests\SimpleTestAbstract;

/**
 * Class PhoneNumberValidationTest
 * @author Anton Zoffmann <anton.zoffmann@getmedusa.org>
 */
class InternationalNumberValidationTest extends SimpleTestAbstract {

    public function provideData(): array {
        return [
            'impressum' => [new InternationalNumberValidation(), false, '089 - 1234 1234'],
            'DIN 5008 ortsvorwahl' => [new InternationalNumberValidation(), false, '0873 376461'],
            'DIN 5008 durchwahl' => [new InternationalNumberValidation(), false, '02433 6534-233'],
            'DIN 5008 international +49' => [new InternationalNumberValidation(), true, '+49 2433 6534-233'],
            'DIN 5008 international 00' => [new InternationalNumberValidation(), true, '0049 2433 6534-233'],
            'DIN 5008 mobil' => [new InternationalNumberValidation(), false, 'Mobil: 0179 1111111'],
            'DIN 5008 sondernummer 1' => [new InternationalNumberValidation(), false, '0180 2 12334'],
            'DIN 5008 sondernummer 2' => [new InternationalNumberValidation(), false, '0800 5 23234213'],
        ];
    }
}
