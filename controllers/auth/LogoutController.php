<?php

declare(strict_types=1);

namespace app\controllers\auth;

use app\controllers\Controller;
use app\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Response;

/**
 * @noinspection PhpUnused
 */
class LogoutController extends Controller
{
    public function behaviors(): array
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'index' => ['post'],
                ],
            ],
        ]);
    }

    public function actionIndex(): Response
    {
        user()->logout();
        session()->setFlash('notification', 'Logged out successfully.');

        return $this->goHome();
    }
}
