<?php

declare(strict_types=1);

namespace app\controllers\tracks;

use app\models\Track;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;

class StopAllUrgeController extends Controller
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
        Track::stopAllUrge();
        Yii::$app->session->setFlash('notification', 'All Urge of track has been stopped.');

        return $this->redirect(['/admin']);
    }
}
