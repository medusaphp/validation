<?php declare(strict_types = 1);
namespace Medusa\Validation\Tests\PhoneNumber;

use Medusa\Validation\PhoneNumber\PhoneNumberValidation;
use Medusa\Validation\Tests\SimpleTestAbstract;

/**
 * Class PhoneNumberValidationTest
 * @author Anton Zoffmann <anton.zoffmann@getmedusa.org>
 */
class PhoneNumberValidationTest extends SimpleTestAbstract {

    public function provideData(): array {
        return [
            'impressum' => [new PhoneNumberValidation(), true, '089 - 1234 1234'],
            'DIN 5008 ortsvorwahl' => [new PhoneNumberValidation(), true, '0873 376461'],
            'DIN 5008 durchwahl' => [new PhoneNumberValidation(), true, '02433 6534-233'],
            'DIN 5008 international +49' => [new PhoneNumberValidation(), true, '+49 2433 6534-233'],
            'DIN 5008 international 00' => [new PhoneNumberValidation(), true, '0049 2433 6534-233'],
            'DIN 5008 mobil' => [new PhoneNumberValidation(), true, 'Mobil: 0179 1111111'],
            'DIN 5008 sondernummer 1' => [new PhoneNumberValidation(), true, '0180 2 12334'],
            'DIN 5008 sondernummer 2' => [new PhoneNumberValidation(), true, '0800 5 23234213'],
        ];
    }
}
