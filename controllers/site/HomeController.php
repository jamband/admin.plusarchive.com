<?php

declare(strict_types=1);

namespace app\controllers\site;

use app\controllers\Controller;
use app\models\Track;
use app\models\MusicGenre;
use yii\data\ActiveDataProvider;

/**
 * @noinspection PhpUnused
 */
class HomeController extends Controller
{
    private const GENRE_LIMIT = 38;

    public function actionIndex(): string
    {
        $query = Track::find()
            ->with('musicGenres')
            ->favorites()
            ->latest();

        return $this->render('/site/home', [
            'data' => new ActiveDataProvider([
                'query' => $query,
                'pagination' => false,
            ]),
            'genres' => MusicGenre::minimal(self::GENRE_LIMIT),
        ]);
    }
}
