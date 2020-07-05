<?php

namespace App\Enum;

use MyCLabs\Enum\Enum;

/**
 * @method static self MOBILE()
 * @method static self LANDLINE()
 *
 * @author Igor Silva <igorqsilva@gmail.com>
 * @version 1.0
 */
class PhoneType extends Enum
{
    private const MOBILE = 'mobile';
    private const LANDLINE = 'landline';
}