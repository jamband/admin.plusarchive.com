<?php

declare(strict_types=1);

namespace app\controllers\musicGenres;

use app\models\MusicGenre;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class DeleteController extends Controller
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

    public function actionIndex(int $id): Response
    {
        $model = MusicGenre::findOne($id);

        if (null === $model) {
            throw new NotFoundHttpException('Page not found.');
        }

        $model->delete();
        Yii::$app->session->setFlash('notification', 'Music genre has been deleted.');

        return $this->redirect(['/musicGenres/admin']);
    }
}