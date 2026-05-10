<?php

declare(strict_types=1);

namespace Etel\Comparable\Implementation;

use Etel\Comparable\Comparator;
use Etel\Comparable\Exception\Uncomparable;

/**
 * Adapts a Comparator to a PHP-native sort callback for use with usort(), uasort(), and uksort().
 *
 * @template T
 */
final readonly class ComparatorCallback
{
    /** @param Comparator<T> $comparator */
    public function __construct(private Comparator $comparator) {}

    /**
     * @param T $a
     * @param T $b
     *
     * @throws Uncomparable When the underlying comparator cannot compare $a and $b
     */
    public function __invoke(mixed $a, mixed $b): int
    {
        return $this->comparator->compare(a: $a, b: $b)->value;
    }
}
