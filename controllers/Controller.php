<?php

/*
 * This file is part of the admin.plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace app\controllers;

use yii\base\Action;
use yii\web\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * @param Action $action
     * @return bool
     */
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
