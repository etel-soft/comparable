<?php

declare(strict_types=1);

namespace Etel\Comparable\Exception;

use Throwable;

/**
 * Exception for cases when instances can not be compared.
 */
interface Uncomparable extends Throwable {}
