<?php declare(strict_types = 1);
namespace Medusa\Validation\PhoneNumber;

use Medusa\Validation\Exception\ValidationException;
use Medusa\Validation\Result\InvalidResult;
use Medusa\Validation\Result\ResultInterface;
use Medusa\Validation\Result\ValidResult;

/**
 * Class InternationalNumberValidation
 * @package medusa/validation
 * @author Anton Zoffmann <anton.zoffmann@getmedusa.org>
 */
class InternationalNumberValidation extends PhoneNumberValidation {

    /**
     * @param mixed $value
     * @csIgnoreParamType $value could be anything
     * @return ResultInterface
     * @throws ValidationException
     */
    protected function doValidation($value): ResultInterface {

        $res = parent::doValidation($value);

        if (!$res->isValid()) {
            return $res;
        }

        if (strpos($res->getValue(), '00') !== 0
            && strpos($res->getValue(), '+') !== 0
        ) {
            return new InvalidResult($res->getValue(), 'Invalid International Number');
        }
        return new ValidResult($res->getValue());
    }
}
