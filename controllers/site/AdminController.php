<?php

declare(strict_types=1);

namespace app\controllers\site;

use app\controllers\Controller;
use app\filters\AccessControl;
use app\models\Track;

class AdminController extends Controller
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
