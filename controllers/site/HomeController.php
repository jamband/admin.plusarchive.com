<?php

declare(strict_types=1);

namespace app\controllers\site;

use app\models\MusicGenre;
use app\models\Track;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class HomeController extends Controller
{
    public function actionIndex(): string
    {
        return $this->render('/site/home', [
            'data' => new ActiveDataProvider([
                'query' => Track::find()
                    ->with('genres')
                    ->favorites()
                    ->latest(),
                'pagination' => false,
            ]),
            'genres' => MusicGenre::minimal(38),
        ]);
    }
}
