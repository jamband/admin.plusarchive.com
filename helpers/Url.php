<?php

declare(strict_types=1);

namespace yii\helpers;

use Yii;
use yii\data\Pagination;

class Url extends BaseUrl
{
    /**
     * Url::current() removing current page index.
     * @see \yii\helpers\Url::current()
     */
    public static function currentPlus(array $params = [], bool|string $scheme = false): string
    {
        /** @var Pagination $pagination */
        $pagination = Yii::createObject(Pagination::class);
        $params = array_merge($params, [$pagination->pageParam => null]);

        return static::current($params, $scheme);
    }
}
