<?php declare(strict_types = 1);
namespace Medusa\Validation\Tests\PhoneNumber;

use Medusa\Validation\PhoneNumber\MobileNumberValidation;
use Medusa\Validation\Tests\SimpleTestAbstract;

/**
 * Class PhoneNumberValidationTest
 * @author Anton Zoffmann <anton.zoffmann@getmedusa.org>
 */
class MobileNumberValidationTest extends SimpleTestAbstract {

    public function provideData(): array {
        return [
            'impressum' => [new MobileNumberValidation(), false, '089 - 1234 1234'],
            'DIN 5008 ortsvorwahl' => [new MobileNumberValidation(), false, '0873 376461'],
            'DIN 5008 durchwahl' => [new MobileNumberValidation(), false, '02433 6534-233'],
            'DIN 5008 international +49' => [new MobileNumberValidation(), false, '+49 2433 6534-233'],
            'DIN 5008 international 00' => [new MobileNumberValidation(), false, '0049 2433 6534-233'],
            'DIN 5008 mobil' => [new MobileNumberValidation(), true, 'Mobil: 0179 1111111'],
            'DIN 5008 sondernummer 1' => [new MobileNumberValidation(), false, '0180 2 12334'],
            'DIN 5008 sondernummer 2' => [new MobileNumberValidation(), false, '0800 5 23234213'],
        ];
    }
}
