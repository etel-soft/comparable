<?php

declare(strict_types=1);

namespace Etel\ComparableTests\Unit\Implementation;

use Etel\Comparable\Implementation\RichComparableTrait;
use Etel\Comparable\Outcome;
use Etel\Comparable\RichComparable;
use Etel\ComparableTests\Unit\UnitTestCase;
use PHPUnit\Framework\Attributes\CoversTrait;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\TestDox;

/**
 * @internal
 */
#[CoversTrait(RichComparableTrait::class)]
final class RichComparableTraitTest extends UnitTestCase
{
    #[Test]
    #[TestDox('Method isEquivalentTo() returns right result')]
    public function testIsEquivalentToMethod(): void
    {
        $this->assertFalse($this->makeSubject(outcome: Outcome::Greater)->isEquivalentTo(other: null));
        $this->assertTrue($this->makeSubject(outcome: Outcome::Equal)->isEquivalentTo(other: null));
        $this->assertFalse($this->makeSubject(outcome: Outcome::Less)->isEquivalentTo(other: null));
    }

    #[Test]
    #[TestDox('Method isGreaterThan() returns right result')]
    public function testIsGreaterThanMethod(): void
    {
        $this->assertTrue($this->makeSubject(outcome: Outcome::Greater)->isGreaterThan(other: null));
        $this->assertFalse($this->makeSubject(outcome: Outcome::Equal)->isGreaterThan(other: null));
        $this->assertFalse($this->makeSubject(outcome: Outcome::Less)->isGreaterThan(other: null));
    }

    #[Test]
    #[TestDox('Method isGreaterOrEqualTo() returns right result')]
    public function testIsGreaterOrEqualToMethod(): void
    {
        $this->assertTrue($this->makeSubject(outcome: Outcome::Greater)->isGreaterOrEqualTo(other: null));
        $this->assertTrue($this->makeSubject(outcome: Outcome::Equal)->isGreaterOrEqualTo(other: null));
        $this->assertFalse($this->makeSubject(outcome: Outcome::Less)->isGreaterOrEqualTo(other: null));
    }

    #[Test]
    #[TestDox('Method isLessThan() returns right result')]
    public function testIsLessThanMethod(): void
    {
        $this->assertFalse($this->makeSubject(outcome: Outcome::Greater)->isLessThan(other: null));
        $this->assertFalse($this->makeSubject(outcome: Outcome::Equal)->isLessThan(other: null));
        $this->assertTrue($this->makeSubject(outcome: Outcome::Less)->isLessThan(other: null));
    }

    #[Test]
    #[TestDox('Method isLessOrEqualTo() returns right result')]
    public function testIsLessOrEqualToMethod(): void
    {
        $this->assertFalse($this->makeSubject(outcome: Outcome::Greater)->isLessOrEqualTo(other: null));
        $this->assertTrue($this->makeSubject(outcome: Outcome::Equal)->isLessOrEqualTo(other: null));
        $this->assertTrue($this->makeSubject(outcome: Outcome::Less)->isLessOrEqualTo(other: null));
    }

    /** @return RichComparable<mixed> */
    private function makeSubject(Outcome $outcome): RichComparable
    {
        return new class($outcome) implements RichComparable {
            use RichComparableTrait;

            public function __construct(private readonly Outcome $outcome) {}

            public function compareTo(mixed $other): Outcome
            {
                return $this->outcome;
            }
        };
    }
}
