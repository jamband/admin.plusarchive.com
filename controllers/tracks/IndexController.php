<?php

declare(strict_types=1);

namespace app\controllers\tracks;

use app\models\Track;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class IndexController extends Controller
{
    public function actionIndex(
        string|null $provider = null,
        string|null $genre = null,
        string|null $search = null,
    ): string {
        $query = Track::find()
            ->with(['genres']);

        if (null !== $provider) {
            $query->provider($provider);
        }

        if (null !== $genre && '' !== $genre) {
            $query->allTagValues($genre);
        }

        if (null !== $search) {
            $query->search($search)
                ->inTitleOrder();
        } else {
            $query->latest();
        }

        return $this->render('//'.$this->id, [
            'data' => new ActiveDataProvider([
                'query' => $query,
                'pagination' => [
                    'pageSize' => 24,
                ],
            ]),
            'provider' => $provider,
            'genre' => $genre,
            'search' => $search,
        ]);
    }
}
