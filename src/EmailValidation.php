<?php declare(strict_types = 1);
namespace Medusa\Validation;

use Medusa\Validation\Result\InvalidResult;
use Medusa\Validation\Result\ResultInterface;
use Medusa\Validation\Result\ValidResult;

/**
 * Class EmailValidation
 * @package medusa/validation
 * @author Anton Zoffmann <anton.zoffmann@getmedusa.org>
 */
class EmailValidation extends ValidationAbstract {

    public const INVALID_EMAIL_FIRSTCHAR = 2;
    public const INVALID_EMAIL_TWODOTS = 3;
    public const INVALID_EMAIL_LASTCHAR = 4;
    public const INVALID_SYNTAX = 5;

    private bool $asciiOnly;

    /**
     * EmailValidation constructor.
     * @param bool $asciiOnly
     */
    public function __construct(bool $asciiOnly = false) {
        $this->asciiOnly = $asciiOnly;
    }

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
        // "(),:;<>@[\] are allowed but only inside ""
        // " and \ would need to be escaped by \
        // so we just don't allow them for easier checking
        $value = strtolower($value);
        $domain = 'a-zàáâãäåæçèéêëìíîïðñòóôõöøùúûüýþÿāăąćĉċčďđēĕėęěĝğġģĥħĩīĭįıĵķĸĺļľłńņňŋōŏőœŕŗřśŝşšßţťŧũūŭůűųŵŷźżž0-9';

        if ($this->asciiOnly) {
            $local = 'a-z0-9';
        } else {
            $local = $domain;
        }

        if (!preg_match('@^[' . $local . '!#$%&\'"*+/=?^_`{|}~.-]+\@(?:[' . $domain . '](?:[' . $domain . '-]*[' . $domain . '])*\.)+[a-z]{2,13}$@iu', $value)) {
            return new InvalidResult($value, 'Invalid email address', self::INVALID_SYNTAX);
        }

        if ($value[0] === '.') {
            return new InvalidResult($value, 'first character of email shall not be "."', self::INVALID_EMAIL_FIRSTCHAR);
        } elseif (strpos($value, '..') !== false) {
            return new InvalidResult($value, 'email may not contain ".."', self::INVALID_EMAIL_TWODOTS);
        }

        $atpos = strpos($value, '@');

        if ($value[$atpos - 1] === '.') {
            // . is not allowed as last character of the local part
            return new InvalidResult($value, 'last character of local part from email shall not be "."', self::INVALID_EMAIL_LASTCHAR);
        }
        return new ValidResult($value);
    }
}
