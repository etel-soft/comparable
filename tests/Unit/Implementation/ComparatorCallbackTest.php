<?php

declare(strict_types=1);

namespace Etel\ComparableTests\Unit\Implementation;

use Etel\Comparable\Comparator;
use Etel\Comparable\Exception\Uncomparable;
use Etel\Comparable\Implementation\ComparatorCallback;
use Etel\Comparable\Implementation\Exception\UncomparableException;
use Etel\Comparable\Outcome;
use Etel\ComparableTests\Unit\UnitTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\TestWith;

use function usort;

/**
 * @internal
 */
#[CoversClass(ComparatorCallback::class)]
final class ComparatorCallbackTest extends UnitTestCase
{
    #[TestWith([Outcome::Less, -1])]
    #[TestWith([Outcome::Equal, 0])]
    #[TestWith([Outcome::Greater, 1])]
    #[TestDox('Returns right result')]
    public function testReturnsMinusOneForLess(Outcome $outcome, int $value): void
    {
        $callback = new ComparatorCallback(comparator: $this->makeComparator(outcome: $outcome));

        $this->assertSame($value, ($callback)(null, null));
    }

    #[Test]
    #[TestDox('Works with usort() to sort an array of integers')]
    public function testWorksWithUsort(): void
    {
        $comparator = new ComparatorCallback(comparator: new class implements Comparator {
            public function compare(mixed $a, mixed $b): Outcome
            {
                return Outcome::fromSpaceship(value: $a <=> $b);
            }
        });

        $items = [3, 1, 4, 1, 5, 9, 2, 6];

        usort(array: $items, callback: $comparator);

        $this->assertSame([1, 1, 2, 3, 4, 5, 6, 9], $items);
    }

    #[Test]
    #[TestDox('Propagates Uncomparable thrown by the underlying comparator')]
    public function testPropagatesUncomparableException(): void
    {
        $this->expectException(Uncomparable::class);

        $callback = new ComparatorCallback(comparator: new class implements Comparator {
            public function compare(mixed $a, mixed $b): Outcome
            {
                throw UncomparableException::create(a: $a, b: $b);
            }
        });

        ($callback)(1, 'string');
    }

    /** @return Comparator<mixed> */
    private function makeComparator(Outcome $outcome): Comparator
    {
        return new readonly class($outcome) implements Comparator {
            public function __construct(private Outcome $outcome) {}

            public function compare(mixed $a, mixed $b): Outcome
            {
                return $this->outcome;
            }
        };
    }
}
