<?php

declare(strict_types=1);

namespace app\controllers\musicGenres;

use app\models\search\MusicGenreSearch;
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
            'search' => $searchModel = new MusicGenreSearch(),
            'data' => $searchModel->search($this->request->queryParams),
        ]);

    }
}
