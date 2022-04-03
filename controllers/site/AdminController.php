<?php

declare(strict_types=1);

namespace app\controllers\site;

use app\controllers\Controller;
use app\filters\AccessControl;
use app\models\Track;
use yii\helpers\ArrayHelper;

class AdminController extends Controller
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
        ]);
    }

    public function actionIndex(): string
    {
        return $this->render('//'.$this->id, [
            'tracks' => Track::find()
                ->favorites()
                ->latest()
                ->all(),
        ]);
    }
}
