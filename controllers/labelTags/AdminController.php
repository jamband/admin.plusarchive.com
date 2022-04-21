<?php

declare(strict_types=1);

namespace app\controllers\labelTags;

use app\models\search\LabelTagSearch;
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
            'search' => $searchModel = new LabelTagSearch(),
            'data' => $searchModel->search($this->request->queryParams),
        ]);
    }
}
