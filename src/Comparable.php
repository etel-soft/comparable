<?php

declare(strict_types=1);

namespace Etel\Compare;

use Etel\Compare\Exception\Uncomparable;

/**
 * Defines method for comparing instance to another.
 */
interface Comparable
{
    /**
     * Returns outcome of comparing the current object to another.
     *
     * @throws Uncomparable When instance can not be compared to provided value
     */
    public function compareTo(mixed $other): Outcome;
}
