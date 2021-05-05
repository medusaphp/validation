<?php declare(strict_types = 1);
namespace Medusa\Validation\Time;

/**
 * Class Iso8601HMSValidation
 * @package medusa/validation
 * @author Anton Zoffmann <anton.zoffmann@getmedusa.org>
 */
class Iso8601HMSValidation extends Iso8601TimeValidationAbstract {

    /**
     * Iso8601HMSValidation constructor.
     * @param bool $withSeparator
     */
    public function __construct(bool $withSeparator) {
        parent::__construct($withSeparator, self::SHOW_MINUTES | self::SHOW_SECONDS);
    }
}
