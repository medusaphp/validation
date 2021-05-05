<?php declare(strict_types = 1);
namespace Medusa\Validation\Date;

/**
 * Class GermanDateValidation
 * @package medusa/validation
 * @author Anton Zoffmann <anton.zoffmann@getmedusa.org>
 */
class GermanDateValidation extends DateFormatValidationAbstract {

    /**
     * @return string
     */
    public function getFormat(): string {
        return 'd.m.Y';
    }
}
