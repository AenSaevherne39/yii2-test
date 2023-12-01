<?php

namespace app\enum;

use Yii;

enum UserStatus: int
{
    case STATUS_DELETED = 0;
    case STATUS_HIDDEN = 1;
    case STATUS_ACTIVE = 10;

    /**
     * @return string
     */
    public function text(): string
    {
        return match ($this) {
            self::STATUS_DELETED => Yii::t('app', 'Active'),
            self::STATUS_HIDDEN => Yii::t('app', 'Deleted'),
            self::STATUS_ACTIVE => Yii::t('app', 'Hidden'),
        };
    }
}
