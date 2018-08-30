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

namespace app\filters;

use Yii;
use yii\filters\AccessControl as BaseAccessControl;
use yii\web\NotFoundHttpException;
use yii\web\User;

class AccessControl extends BaseAccessControl
{
    /**
     * @param false|User
     * @return void
     * @throws NotFoundHttpException
     */
    protected function denyAccess($user): void
    {
        throw new NotFoundHttpException(Yii::t('yii', 'Page not found.'));
    }
}
