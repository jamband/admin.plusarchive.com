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

namespace app\models;

use yii\base\UserException;

class NotFoundModelException extends UserException
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return 'Not Found Model';
    }
}