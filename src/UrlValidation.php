<?php declare(strict_types = 1);
namespace Medusa\Validation;

use Medusa\Validation\Result\InvalidResult;
use Medusa\Validation\Result\ResultInterface;
use Medusa\Validation\Result\ValidResult;

/**
 * Class UrlValidation
 * @package medusa/validation
 * @author  Anton Zoffmann <anton.zoffmann@getmedusa.org>
 */
class UrlValidation extends ValidationAbstract {

    /**
     * @return StringValidation[]
     */
    public function dependsOn(): array {
        return [
            new StringValidation(true),
        ];
    }

    /**
     * @param mixed $value
     * @csIgnoreParamType $value could be anything
     * @return ResultInterface
     * @throws Exception\ValidationException
     */
    protected function doValidation($value): ResultInterface {

        if (!$parsed = parse_url($value)) {
            return new InvalidResult($parsed, 'malformed url');
        }

        if (!isset($parsed['host'])) {
            return new InvalidResult($parsed, 'host is missing');
        }

        return new ValidResult($value);
    }
}
