<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace app\commands;

use yii\console\Controller;

/**
 * RbacController class file.
 */
class RbacController extends Controller
{
    /**
     * Initialization.
    public function actionInit()
    {
        $auth = app()->authManager;
        $auth->removeAll();

        $admin = $auth->createRole('admin');
        $admin->description = 'Administrator';
        $auth->add($admin);
        $auth->assign($admin, 1);
    }
     */
}
