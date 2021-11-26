<?php

declare(strict_types=1);

namespace app\controllers;

use yii\web\Controller as BaseController;

/**
 * @noinspection PhpUnused
 */
class Controller extends BaseController
{
    public function beforeAction($action): bool
    {
        if (!parent::beforeAction($action)) {
            return false;
        }

        if (user()->can('admin')) {
            $this->layout = 'admin/main';
        }

        return true;
    }
}
