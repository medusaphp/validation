<?php declare(strict_types = 1);
namespace Medusa\Validation\PhoneNumber;

use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumber;
use libphonenumber\PhoneNumberUtil;
use Medusa\Validation\Exception\ValidationException;
use Medusa\Validation\Result\InvalidResult;
use Medusa\Validation\Result\ResultInterface;
use Medusa\Validation\Result\ValidResult;
use Medusa\Validation\StringValidation;
use Medusa\Validation\ValidationAbstract;
use Throwable;

/**
 * Class PhoneNumberValidation
 * @package medusa/validation
 * @author Anton Zoffmann <anton.zoffmann@getmedusa.org>
 */
class PhoneNumberValidation extends ValidationAbstract {

    protected string $defaultIso2 = 'DE';

    private PhoneNumberUtil $util;

    private array $cache = [];

    /**
     * @return StringValidation[]
     */
    public function dependsOn(): array {
        return [
            new StringValidation(),
        ];
    }

    /**
     * @param mixed $number
     * @csIgnoreParamType $number could by any type
     * @return ResultInterface
     * @throws ValidationException
     */
    protected function doValidation($number): ResultInterface {
        try {
            if (strpos($number, '00') === 0) {
                $number = '+' . substr($number, 2);
            }

            $res = $this->parse($number);
            if ($res === null) {
                return new InvalidResult($number, 'PhoneNumber not parseable');
            }

            if (!$this->getUtil()->isValidNumber($res)) {
                return new InvalidResult($number, 'PhoneNumber not valid');
            }

            return new ValidResult($number);
        } catch (NumberParseException $e) {
            return new InvalidResult($number, $e->getMessage());
        } catch (Throwable $e) {
            return new InvalidResult($number, 'PhoneNumberValidation failed');
        }
    }

    /**
     * @param string $number
     * @return PhoneNumber|null
     * @throws NumberParseException
     */
    protected function parse(string $number): ?PhoneNumber {
        if (isset($this->cache[$this->defaultIso2][$number])) {
            return $this->cache[$this->defaultIso2][$number];
        }
        $this->cache[$this->defaultIso2] ??= [];
        // its about not doing this twice
        $this->cache[$this->defaultIso2][$number] = $this->getUtil()->parse($number, $this->defaultIso2);
        return $this->cache[$this->defaultIso2][$number];
    }

    /**
     * @return PhoneNumberUtil
     */
    protected function getUtil(): PhoneNumberUtil {
        return $this->util ??= PhoneNumberUtil::getInstance();
    }
}
