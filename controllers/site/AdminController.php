<?php

declare(strict_types=1);

namespace app\controllers\site;

use app\models\Track;
use yii\filters\AccessControl;
use yii\web\Controller;

class AdminController extends Controller
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

    public function actionIndex(): string
    {
        return $this->render('//'.$this->id, [
            'tracks' => Track::find()
                ->with(['genres'])
                ->favorites()
                ->latest()
                ->all(),
        ]);
    }
}
