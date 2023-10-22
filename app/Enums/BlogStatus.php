<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class BlogStatus extends Enum
{
    const ZERO = 0;
    const LATEST = 10;
    const OptionTwo = 1;
    const OptionThree = 2;
}
