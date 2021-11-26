<?php

declare(strict_types=1);

namespace app\filters;

use Yii;
use yii\filters\AccessControl as BaseAccessControl;
use yii\web\NotFoundHttpException;

class AccessControl extends BaseAccessControl
{
    protected function denyAccess($user): void
    {
        throw new NotFoundHttpException(Yii::t('yii', 'Page not found.'));
    }
}
