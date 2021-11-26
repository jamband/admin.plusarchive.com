<?php

declare(strict_types=1);

namespace app\commands;

use yii\console\Controller;
use yii\console\ExitCode;

/**
 * Manages access control
 * @noinspection PhpUnused
 */
class RbacController extends Controller
{
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
