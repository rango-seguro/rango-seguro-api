<?php

namespace App\Enum;

use MyCLabs\Enum\Enum;

/**
 * @method static self ACTIVE()
 * @method static self INACTIVE()
 * @method static self ARCHIVED()
 *
 * @author Igor Silva <igorqsilva@gmail.com>
 * @version 1.0
 */
class Status extends Enum
{
    private const ACTIVE = 'active';
    private const INACTIVE = 'inactive';
    private const ARCHIVED = 'archived';
}