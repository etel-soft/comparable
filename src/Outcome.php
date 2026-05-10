<?php

declare(strict_types=1);

namespace Etel\Comparable;

/**
 * Possible outcomes of comparison operations.
 */
enum Outcome: int
{
    case Equal = 0;
    case Greater = 1;
    case Less = -1;

    /**
     * Returns TRUE when the outcome is equal, FALSE otherwise.
     */
    public function isEqual(): bool
    {
        return $this === self::Equal;
    }

    /**
     * Returns TRUE when the outcome is greater, FALSE otherwise.
     */
    public function isGreater(): bool
    {
        return $this === self::Greater;
    }

    /**
     * Returns TRUE when the outcome is greater or equal, FALSE otherwise.
     */
    public function isGreaterOrEqual(): bool
    {
        return $this === self::Greater || $this === self::Equal;
    }

    /**
     * Returns TRUE when the outcome is less, FALSE otherwise.
     */
    public function isLess(): bool
    {
        return $this === self::Less;
    }

    /**
     * Returns TRUE when the outcome is less or equal, FALSE otherwise.
     */
    public function isLessOrEqual(): bool
    {
        return $this === self::Less || $this === self::Equal;
    }

    /**
     * Returns the inverse outcome: Greater becomes Less, Less becomes Greater, Equal stays Equal.
     */
    public function reverse(): self
    {
        return match ($this) {
            self::Greater => self::Less,
            self::Less => self::Greater,
            self::Equal => self::Equal
        };
    }

    /**
     * Creates an Outcome from a spaceship-operator result (negative, zero, or positive integer).
     */
    public static function fromSpaceship(int $value): self
    {
        return match (true) {
            $value > 0 => self::Greater,
            $value < 0 => self::Less,
            default => self::Equal
        };
    }
}
