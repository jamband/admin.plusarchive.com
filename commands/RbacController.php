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

namespace app\commands;

use yii\console\Controller;
use yii\console\ExitCode;

/**
 * RbacController class file.
 */
class RbacController extends Controller
{
    /**
     * Initialization.
     *
     * @return int
     */
    public function actionInit(): int
    {
        // $auth = app()->authManager;
        // $auth->removeAll();

        // $admin = $auth->createRole('admin');
        // $admin->description = 'Administrator';
        // $auth->add($admin);
        // $auth->assign($admin, 1);

        return ExitCode::OK;
    }
}
