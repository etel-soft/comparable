<?php

declare(strict_types=1);

namespace Etel\Comparable\Implementation;

use Etel\Comparable\Outcome;

/**
 * Provides default implementations of all RichComparable boolean methods by delegating to compareTo().
 * Classes using this trait only need to implement compareTo() with domain-specific logic.
 */
trait RichComparableTrait
{
    abstract public function compareTo(mixed $other): Outcome;

    public function isEquivalentTo(mixed $other): bool
    {
        return $this->compareTo(other: $other)->isEqual();
    }

    public function isGreaterThan(mixed $other): bool
    {
        return $this->compareTo(other: $other)->isGreater();
    }

    public function isGreaterOrEqualTo(mixed $other): bool
    {
        return $this->compareTo(other: $other)->isGreaterOrEqual();
    }

    public function isLessThan(mixed $other): bool
    {
        return $this->compareTo(other: $other)->isLess();
    }

    public function isLessOrEqualTo(mixed $other): bool
    {
        return $this->compareTo(other: $other)->isLessOrEqual();
    }
}
