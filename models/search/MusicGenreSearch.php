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

namespace app\models\search;

use app\models\MusicGenre;
use yii\data\ActiveDataProvider;

class MusicGenreSearch extends MusicGenre
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            ['name', 'trim'],
            ['name', 'safe'],
        ];
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search(array $params = []): ActiveDataProvider
    {
        $query = MusicGenre::find();

        $data = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                ]
            ],
        ]);

        if ($this->load($params) && $this->validate()) {
            $query->andFilterWhere(['like', 'name', $this->name]);
        }

        return $data;
    }
}
