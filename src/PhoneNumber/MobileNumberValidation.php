<?php declare(strict_types = 1);
namespace Medusa\Validation\PhoneNumber;

use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumberType;
use Medusa\Validation\Exception\ValidationException;
use Medusa\Validation\Result\InvalidResult;
use Medusa\Validation\Result\ResultInterface;
use Medusa\Validation\Result\ValidResult;

/**
 * Class MobileNumberValidation
 * @package medusa/validation
 * @author Anton Zoffmann <anton.zoffmann@getmedusa.org>
 */
class MobileNumberValidation extends PhoneNumberValidation {

    /**
     * @param mixed $value
     * @csIgnoreParamType $value could be anything
     * @return ResultInterface
     * @throws ValidationException
     * @throws NumberParseException
     */
    protected function doValidation($value): ResultInterface {

        $res = parent::doValidation($value);

        if (!$res->isValid()) {
            return $res;
        }

        // access prefilled instance cache from parent
        $parsed = $this->parse($value);

        if (!in_array($this->getUtil()->getNumberType($parsed), [
             PhoneNumberType::FIXED_LINE_OR_MOBILE,
             PhoneNumberType::MOBILE,
             PhoneNumberType::PERSONAL_NUMBER])
        ) {
            return new InvalidResult($value, 'Invalid Mobile Number');
        }
        return new ValidResult($value);
    }
}
