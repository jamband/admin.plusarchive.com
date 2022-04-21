<?php

declare(strict_types=1);

namespace app\controllers\labelTags;

use app\models\LabelTag;
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
        $model = LabelTag::findOne($id);

        if (null === $model) {
            throw new NotFoundHttpException('Page not found.');
        }

        $model->delete();
        Yii::$app->session->setFlash('notification', 'Label tag has been deleted.');

        return $this->redirect(['/labelTags/admin/index']);
    }
}
