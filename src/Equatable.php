<?php

declare(strict_types=1);

namespace Etel\Comparable;

/**
 * Defines method for determining semantic equality of instances.
 *
 * @template T
 */
interface Equatable
{
    /**
     * Determines if two objects are semantically identical (value equality).
     * Returns TRUE when the current object is equal to the other, FALSE otherwise.
     *
     * @param T $other
     */
    public function isEqualTo(mixed $other): bool;
}
