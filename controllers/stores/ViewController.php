<?php

declare(strict_types=1);

namespace app\controllers\stores;

use app\models\Store;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ViewController extends Controller
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

    public function actionIndex(int $id): string
    {
        $model = Store::findOne($id);

        if (null === $model) {
            throw new NotFoundHttpException('Page not found.');
        }

        return $this->render('//'.$this->id, [
            'model' => $model,
        ]);
    }
}
