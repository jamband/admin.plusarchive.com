<?php

declare(strict_types=1);

namespace app\controllers\playlists;

use app\models\Playlist;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class IndexController extends Controller
{
    public function actionIndex(): string
    {
        return $this->render('//'.$this->id, [
            'data' => new ActiveDataProvider([
                'query' => Playlist::find()
                    ->latest(),
                'pagination' => false,
            ]),
        ]);
    }
}
