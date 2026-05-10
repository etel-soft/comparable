<?php

declare(strict_types=1);

namespace Etel\Comparable\Implementation\Exception;

use Etel\Comparable\Exception\Uncomparable;
use InvalidArgumentException;

use function get_debug_type;
use function sprintf;

/**
 * Thrown when two values cannot be compared to each other, typically due to a type mismatch.
 */
final class UncomparableException extends InvalidArgumentException implements Uncomparable
{
    /**
     * Creates an exception with a message describing the types of the two incompatible values.
     * Pass $explain to append a human-readable reason to the message.
     */
    public static function create(mixed $a, mixed $b, ?string $explain = null): self
    {
        return new self(message: sprintf(
            'Unable to compare %s with %s%s.',
            get_debug_type(value: $a),
            get_debug_type(value: $b),
            $explain ? sprintf(': %s', $explain) : ''
        ));
    }
}
