<?php

declare(strict_types=1);

namespace Etel\Compare\Domain;

/**
 * Defines method for determining logical equality of instances.
 */
interface Equatable
{
    /**
     * Determines if two objects are logically identical (value equality). This means that, for example,
     * `new Decimal('1.0')->isEqualTo(new Decimal('1.00'))` should return false (since they have different scales).
     *
     * Returns TRUE when the current object is equal to the other, FALSE otherwise.
     */
    public function isEqualTo(mixed $other): bool;
}
