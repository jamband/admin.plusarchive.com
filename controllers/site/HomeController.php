<?php

/*
 * This file is part of the admin.plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace app\controllers\site;

use app\controllers\Controller;
use app\models\Track;
use app\models\MusicGenre;
use yii\data\ActiveDataProvider;

class HomeController extends Controller
{
    private const GENRE_LIMIT = 38;

    /**
     * @return string
     */
    public function actionIndex(): string
    {
        $query = Track::find()
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
