<?php

declare(strict_types=1);

namespace app\controllers\labels;

use app\models\Label;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class IndexController extends Controller
{
    public function actionIndex(
        string|null $country = null,
        string|null $tag = null,
        string|null $search = null,
    ): string {
        $query = Label::find()
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
