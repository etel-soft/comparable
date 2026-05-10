<?php

declare(strict_types=1);

namespace Etel\Comparable;

use Etel\Comparable\Exception\Uncomparable;

/**
 * Defines an external comparison strategy for objects of type T.
 *
 * Implement this interface when comparison logic should live outside the objects
 * being compared — for example, to support multiple orderings of the same type
 * or to compare third-party classes that cannot implement Comparable themselves.
 *
 * @template T
 */
interface Comparator
{
    /**
     * Compares two values and returns their relative order.
     * Returns Outcome::Equal when $a equals $b, Outcome::Greater when $a is greater, Outcome::Less when $a is less.
     *
     * @param T $a
     * @param T $b
     *
     * @throws Uncomparable When $a and $b cannot be compared (e.g. type mismatch)
     */
    public function compare(mixed $a, mixed $b): Outcome;
}
