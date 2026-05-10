<?php

declare(strict_types=1);

namespace Etel\Comparable;

use Etel\Comparable\Exception\Uncomparable;

/**
 * Extends Comparable with convenience boolean methods for checking relative order.
 *
 * @template T
 * @extends Comparable<T>
 */
interface RichComparable extends Comparable
{
    /**
     * Returns TRUE when the current object is equivalent to the other in ordering terms (neither greater nor less),
     * FALSE otherwise.
     * Note: may differ from value equality defined by Equatable::isEqualTo().
     *
     * @param T $other
     *
     * @throws Uncomparable When instance can not be compared to provided value
     */
    public function isEquivalentTo(mixed $other): bool;

    /**
     * Returns TRUE when the current object is greater than the other, FALSE otherwise.
     *
     * @param T $other
     *
     * @throws Uncomparable When instance can not be compared to provided value
     */
    public function isGreaterThan(mixed $other): bool;

    /**
     * Returns TRUE when the current object is greater than or equal to the other, FALSE otherwise.
     *
     * @param T $other
     *
     * @throws Uncomparable When instance can not be compared to provided value
     */
    public function isGreaterOrEqualTo(mixed $other): bool;

    /**
     * Returns TRUE when the current object is less than the other, FALSE otherwise.
     *
     * @param T $other
     *
     * @throws Uncomparable When instance can not be compared to provided value
     */
    public function isLessThan(mixed $other): bool;

    /**
     * Returns TRUE when the current object is less than or equal to the other, FALSE otherwise.
     *
     * @param T $other
     *
     * @throws Uncomparable When instance can not be compared to provided value
     */
    public function isLessOrEqualTo(mixed $other): bool;
}
