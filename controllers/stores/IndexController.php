<?php

declare(strict_types=1);

namespace app\controllers\stores;

use app\models\Store;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class IndexController extends Controller
{
    public function actionIndex(
        string|null $country = null,
        string|null $tag = null,
        string|null $search = null,
    ): string {
        $query = Store::find()
            ->with(['tags']);

        if (null !== $country) {
            $query->country($country);
        }

        if (null !== $tag) {
            $query->allTagValues($tag);
        }

        if (null !== $search) {
            $query->search($search)
                ->inNameOrder();
        } else {
            $query->latest();
        }

        return $this->render('//'.$this->id, [
            'data' => new ActiveDataProvider([
                'query' => $query,
                'pagination' => [
                    'pageSize' => 8,
                ],
            ]),
            'country' => $country,
            'tag' => $tag,
            'search' => $search,
        ]);
    }
}
