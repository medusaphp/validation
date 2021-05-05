<?php declare(strict_types = 1);
namespace Medusa\Validation\Date;

/**
 * Class Iso8601DateValidation
 * @package medusa/validation
 * @author Anton Zoffmann <anton.zoffmann@getmedusa.org>
 */
class Iso8601DateValidation extends DateFormatValidationAbstract {

    /**
     * @return string
     */
    public function getFormat(): string {
        return 'Y-m-d';
    }
}
