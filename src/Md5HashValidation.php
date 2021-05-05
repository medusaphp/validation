<?php declare(strict_types = 1);
namespace Medusa\Validation;

/**
 * @package medusa/validation
 * @author  Pascal Schnell <pascal.schnell@getmedusa.org>
 */
class Md5HashValidation extends HashValidation {

    /**
     * Md5HashValidation constructor.
     */
    public function __construct() {
        parent::__construct(32);
    }
}
