<?php

declare(strict_types=1);

namespace app\controllers\stores;

use app\models\Store;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class UpdateController extends Controller
{
    public $layout = 'admin/main';

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
        ];
    }

    public function actionIndex(int $id): string|Response
    {
        $model = Store::findOne($id);

        if (null === $model) {
            throw new NotFoundHttpException('Page not found.');
        }

        if ($model->load($this->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('notification', 'Store has been updated.');

            return $this->redirect(['/stores/view/index', 'id' => $model->id]);
        }

        return $this->render('//'.$this->id, [
            'model' => $model,
        ]);
    }
}
