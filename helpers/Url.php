<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace yii\helpers;

use yii\data\Pagination;

class Url extends BaseUrl
{
    /**
     * Url::current() removing current page index.
     *
     * @param array $params
     * @param bool|string $scheme
     * @return string
     * @see \yii\helpers\Url::current()
     */
    public static function currentPlus(array $params = [], $scheme = false): string
    {
        $params = array_merge($params, [(new Pagination)->pageParam => null]);

        return static::current($params, $scheme);
    }
}
