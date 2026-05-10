<?php

declare(strict_types=1);

namespace Etel\Comparable;

use Etel\Comparable\Exception\Uncomparable;

/**
 * Defines a natural ordering for objects of the implementing class.
 *
 * Implement this interface when objects have a single, canonical ordering —
 * for example, monetary amounts by value or versions by precedence.
 * For multiple or external orderings use Comparator instead.
 *
 * @template T
 */
interface Comparable
{
    /**
     * Compares the current object to $other and returns their relative order.
     * Returns Outcome::Equal when equal, Outcome::Greater when the current object is greater,
     * and Outcome::Less when the current object is less than $other.
     *
     * @param T $other
     *
     * @throws Uncomparable When the current object cannot be compared to $other (e.g. type mismatch)
     */
    public function compareTo(mixed $other): Outcome;
}
