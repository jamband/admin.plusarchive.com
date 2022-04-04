<?php

declare(strict_types=1);

namespace app\controllers\auth;

use app\controllers\Controller;
use app\filters\AccessControl;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Response;

class LogoutController extends Controller
{
    public function behaviors(): array
    {
        return [
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
        ];
    }

    public function actionIndex(): Response
    {
        Yii::$app->user->logout();
        Yii::$app->session->setFlash('notification', 'Logged out successfully.');

        return $this->goHome();
    }
}
