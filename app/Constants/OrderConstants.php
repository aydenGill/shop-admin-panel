<?php

namespace App\Constants;

class OrderConstants
{
    public const ACTIVE = 'active';

    public const CREATED = 'created';

    public const SUCCESS = 'success';

    public const FAILED = 'failed';

    public const CANCELLED = 'cancelled';

    public static function getStatusFromId($id)
    {
        switch ($id) {
            case 1:
                return self::SUCCESS;
            case 2:
                return self::FAILED;
            default:
                return self::ACTIVE;
        }
    }

    public static function getStatusFromString($status)
    {
        switch ($status) {
            case self::SUCCESS:
                return 1;
            case self::FAILED:
                return 2;
            default:
                return self::ACTIVE;
        }
    }
}
