<?php declare(strict_types = 1);
namespace Medusa\Validation\Result;

/**
 * Interface ResultInterface
 * @package medusa/validation
 * @author  Pascal Schnell <pascal.schnell@getmedusa.org>
 */
interface ResultInterface {

    /**
     * @return bool
     */
    public function isValid(): bool;

    /**
     * @return mixed
     * @csIgnoreMixedReturn because could be anything
     */
    public function getValue();

    /**
     * @return int
     */
    public function getReturnCode(): int;

    /**
     * @return string
     */
    public function getReason(): string;
}
