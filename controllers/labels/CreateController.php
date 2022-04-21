<?php

declare(strict_types=1);

namespace app\controllers\labels;

use app\models\Label;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;

class CreateController extends Controller
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

    public function actionIndex(): string|Response
    {
        $model = new Label();
        $model->loadDefaultValues();

        if ($model->load($this->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('notification', 'Label has been added.');

            return $this->redirect(['/labels/view/index', 'id' => $model->id]);
        }

        return $this->render('//'.$this->id, [
            'model' => $model,
        ]);
    }
}
