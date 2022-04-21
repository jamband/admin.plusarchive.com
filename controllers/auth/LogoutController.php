<?php

declare(strict_types=1);

namespace app\controllers\auth;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
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
                'actions' => ['index' => ['POST']],
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
