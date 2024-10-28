<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Attributes\Description;
use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class Profile extends Enum
{
    #[Description('L Rectangle')]
    const LRectangle = 'l_ectangle';

    #[Description('Z Door')]
    const ZDoor = 'z_door';

    #[Description('Z Window')]
    const ZWindow = 'z_window';

    #[Description('T Inside')]
    const TInside = 't_inside';

    #[Description('L Slide')]
    const LSlide = 'l_slide';

    #[Description('Z Door Slide')]
    const ZDoorSlide = 'z_door_slide';

    #[Description('T Inside Slide')]
    const TInsideSlide = 't_inside_slide';
}
