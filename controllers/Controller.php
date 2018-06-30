<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace app\controllers;

use yii\web\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * {@inheritdoc}
     */
    public function beforeAction($action)
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
