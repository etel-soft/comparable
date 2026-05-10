<?php

declare(strict_types=1);

namespace Etel\ComparableTests\Unit;

use Etel\Comparable\Equatable;
use Etel\Comparable\Exception\Uncomparable;
use Etel\Comparable\Implementation\Exception\UncomparableException;
use Etel\Comparable\Implementation\RichComparableTrait;
use Etel\Comparable\Outcome;
use Etel\Comparable\RichComparable;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\TestDox;

use function abs;

/**
 * Contract test: a class can implement both Equatable and RichComparable without conflict.
 *
 * isEqualTo() — value equality; isEquivalentTo() — ordering equality.
 * They are intentionally independent and may return different results for the same pair.
 *
 * @internal
 */
final class EquatableAndRichComparableContractTest extends UnitTestCase
{
    #[Test]
    #[TestDox('A class can implement Equatable and RichComparable simultaneously')]
    public function testClassImplementsBothInterfaces(): void
    {
        $subject = $this->makeSubject(value: 5);

        /* @noinspection PhpConditionAlreadyCheckedInspection */
        $this->assertInstanceOf(Equatable::class, $subject);
        /* @noinspection PhpConditionAlreadyCheckedInspection */
        $this->assertInstanceOf(RichComparable::class, $subject);
    }

    #[Test]
    #[TestDox('isEqualTo() and isEquivalentTo() are independent and can differ')]
    public function testEqualityAndEquivalenceCanDiffer(): void
    {
        $positive = $this->makeSubject(value: 5);
        $negative = $this->makeSubject(value: -5);

        // Not the same value — value equality fails
        $this->assertFalse($positive->isEqualTo(other: $negative));

        // Same absolute value — ordering equivalence holds
        $this->assertTrue($positive->isEquivalentTo(other: $negative));
    }

    #[Test]
    #[TestDox('isEqualTo() and isEquivalentTo() both return true for identical values')]
    public function testBothReturnTrueForIdenticalValues(): void
    {
        $a = $this->makeSubject(value: 5);
        $b = $this->makeSubject(value: 5);

        $this->assertTrue($a->isEqualTo(other: $b));
        $this->assertTrue($a->isEquivalentTo(other: $b));
    }

    #[Test]
    #[TestDox('RichComparable boolean helpers work correctly alongside Equatable')]
    public function testRichComparableHelpersWorkAlongside(): void
    {
        $three = $this->makeSubject(value: 3);
        $five = $this->makeSubject(value: 5);

        $this->assertTrue($five->isGreaterThan(other: $three));
        $this->assertTrue($three->isLessThan(other: $five));
        $this->assertFalse($three->isEqualTo(other: $five));
    }

    #[Test]
    #[TestDox('compareTo() throws Uncomparable for incompatible types')]
    public function testComparesToThrowsForIncompatibleTypes(): void
    {
        $this->expectException(Uncomparable::class);

        $this->makeSubject(value: 1)->compareTo(other: 'string');
    }

    /**
     * @return Equatable<mixed>&RichComparable<mixed>
     */
    private function makeSubject(int $value): Equatable&RichComparable
    {
        /* @noinspection PhpIncompatibleReturnTypeInspection */
        return new readonly class($value) implements Equatable, RichComparable {
            use RichComparableTrait;

            public function __construct(private int $value) {}

            public function isEqualTo(mixed $other): bool
            {
                return $other instanceof self && $other->value === $this->value;
            }

            public function compareTo(mixed $other): Outcome
            {
                if (!$other instanceof self) {
                    throw UncomparableException::create(a: $this, b: $other);
                }

                return Outcome::fromSpaceship(value: abs(num: $this->value) <=> abs(num: $other->value));
            }
        };
    }
}
