<?php

declare(strict_types=1);

namespace Etel\ComparableTests\Unit;

use Etel\Comparable\Outcome;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\TestDox;

/**
 * @internal
 */
#[CoversClass(Outcome::class)]
final class OutcomeTest extends UnitTestCase
{
    #[Test]
    #[TestDox('Equal has value 0, Greater has value 1, Less has value -1')]
    public function testCasesValues(): void
    {
        $this->assertSame(1, Outcome::Greater->value);
        $this->assertSame(0, Outcome::Equal->value);
        $this->assertSame(-1, Outcome::Less->value);
    }

    #[Test]
    #[TestDox('Method isEqual() returns right result')]
    public function testIsEqualMethod(): void
    {
        $this->assertFalse(Outcome::Greater->isEqual());
        $this->assertTrue(Outcome::Equal->isEqual());
        $this->assertFalse(Outcome::Less->isEqual());
    }

    #[Test]
    #[TestDox('Method isGreater() returns right result')]
    public function testIsGreaterMethod(): void
    {
        $this->assertTrue(Outcome::Greater->isGreater());
        $this->assertFalse(Outcome::Equal->isGreater());
        $this->assertFalse(Outcome::Less->isGreater());
    }

    #[Test]
    #[TestDox('Method isGreaterOrEqual() returns right result')]
    public function testIsGreaterOrEqualMethod(): void
    {
        $this->assertTrue(Outcome::Greater->isGreaterOrEqual());
        $this->assertTrue(Outcome::Equal->isGreaterOrEqual());
        $this->assertFalse(Outcome::Less->isGreaterOrEqual());
    }

    #[Test]
    #[TestDox('Method isLess() returns right result')]
    public function testIsLessMethod(): void
    {
        $this->assertFalse(Outcome::Greater->isLess());
        $this->assertFalse(Outcome::Equal->isLess());
        $this->assertTrue(Outcome::Less->isLess());
    }

    #[Test]
    #[TestDox('Method isLessOrEqual() returns right result')]
    public function testIsLessOrEqualMethod(): void
    {
        $this->assertFalse(Outcome::Greater->isLessOrEqual());
        $this->assertTrue(Outcome::Equal->isLessOrEqual());
        $this->assertTrue(Outcome::Less->isLessOrEqual());
    }

    #[Test]
    #[TestDox('Method reverse() maps right cases')]
    public function testReverseMethod(): void
    {
        $this->assertSame(Outcome::Greater, Outcome::Less->reverse());
        $this->assertSame(Outcome::Equal, Outcome::Equal->reverse());
        $this->assertSame(Outcome::Less, Outcome::Greater->reverse());
    }

    #[Test]
    #[TestDox('Method fromSpaceship() maps right values')]
    public function testFromSpaceshipMethod(): void
    {
        $this->assertSame(Outcome::Greater, Outcome::fromSpaceship(1));
        $this->assertSame(Outcome::Equal, Outcome::fromSpaceship(0));
        $this->assertSame(Outcome::Less, Outcome::fromSpaceship(-1));
    }

    #[Test]
    #[TestDox('Method fromSpaceship() maps any positive or negative integer to right case')]
    public function testFromSpaceshipMethodForLargeIntegers(): void
    {
        $this->assertSame(Outcome::Greater, Outcome::fromSpaceship(42));
        $this->assertSame(Outcome::Less, Outcome::fromSpaceship(-42));
    }
}
