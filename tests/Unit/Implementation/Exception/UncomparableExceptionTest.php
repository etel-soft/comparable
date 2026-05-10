<?php

declare(strict_types=1);

namespace Etel\ComparableTests\Unit\Implementation\Exception;

use Etel\Comparable\Exception\Uncomparable;
use Etel\Comparable\Implementation\Exception\UncomparableException;
use Etel\ComparableTests\Unit\UnitTestCase;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\TestDox;
use RuntimeException;
use stdClass;

/**
 * @internal
 */
#[CoversClass(UncomparableException::class)]
final class UncomparableExceptionTest extends UnitTestCase
{
    #[Test]
    #[TestDox('Implements required contracts')]
    public function testImplementsContracts(): void
    {
        $exception = UncomparableException::create(a: new stdClass(), b: 'test');

        /* @noinspection PhpConditionAlreadyCheckedInspection */
        $this->assertInstanceOf(Uncomparable::class, $exception);
        /* @noinspection PhpConditionAlreadyCheckedInspection */
        $this->assertInstanceOf(InvalidArgumentException::class, $exception);
    }

    #[Test]
    #[TestDox('Message without explain ends with a period')]
    public function testMessageWithoutExplain(): void
    {
        $exception = UncomparableException::create(a: new stdClass(), b: 'text');

        $this->assertSame('Unable to compare stdClass with string.', $exception->getMessage());
    }

    #[Test]
    #[TestDox('Message with explain appends the reason after a colon')]
    public function testMessageWithExplain(): void
    {
        $exception = UncomparableException::create(a: new stdClass(), b: 'text', explain: 'different currencies');

        $this->assertSame(
            'Unable to compare stdClass with string: different currencies.',
            $exception->getMessage()
        );
    }

    #[Test]
    #[TestDox('Empty string explain is treated the same as null')]
    public function testEmptyExplainIsIgnored(): void
    {
        $exception = UncomparableException::create(a: new stdClass(), b: 'text', explain: '');

        $this->assertSame('Unable to compare stdClass with string.', $exception->getMessage());
    }

    #[Test]
    #[TestDox('Works with null values')]
    public function testWorksWithNullValues(): void
    {
        $exception = UncomparableException::create(a: null, b: null);

        $this->assertSame('Unable to compare null with null.', $exception->getMessage());
    }

    #[Test]
    #[TestDox('Preserves previous exception as the cause')]
    public function testPreservesPreviousException(): void
    {
        $previous = new RuntimeException(message: 'original cause');
        $exception = UncomparableException::create(a: new stdClass(), b: 'text', previous: $previous);

        $this->assertSame($previous, $exception->getPrevious());
    }
}
