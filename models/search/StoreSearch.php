<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace app\models\search;

use yii\data\ActiveDataProvider;
use app\models\Store;
use app\models\StoreTag;

class StoreSearch extends Store
{
    public $tag;

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['name', 'link'], 'trim'],
            [['name', 'country', 'link', 'tag'], 'safe'],

            ['country', 'in', 'range' => static::getCountries()],
            ['tag', 'in', 'range' => StoreTag::getNames()->column()],
        ];
    }

    /**
     * Creates data provider instance with search query applied.
     *
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search(array $params = []): ActiveDataProvider
    {
        $query = Store::find()
            ->with(['storeTags']);

        $data = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                ],
            ],
        ]);

        if ($this->load($params) && $this->validate()) {
            $query->andFilterWhere(['like', static::tableName().'.name', $this->name])
                ->andFilterWhere(['country' => $this->country])
                ->andFilterWhere(['like', 'link', $this->link]);

            if ('' !== $this->tag) {
                $query->allTagValues($this->tag);
            }
        }

        return $data;
    }
}
