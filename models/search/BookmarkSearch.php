<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace app\models\search;

use app\models\Bookmark;
use app\models\BookmarkTag;
use yii\data\ActiveDataProvider;

class BookmarkSearch extends Bookmark
{
    public $tag;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'link'], 'trim'],
            [['name', 'country', 'link', 'status', 'tag'], 'safe'],

            ['country', 'in', 'range' => static::getCountries()],
            ['status', 'in', 'range' => array_keys(self::STATUSES)],
            ['tag', 'in', 'range' => BookmarkTag::getNames()->column()],
        ];
    }

    /**
     * Creates data provider instance with search query applied
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search(array $params = [])
    {
        $query = Bookmark::find()
            ->with(['bookmarkTags']);

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
                ->andFilterWhere(['like', 'link', $this->link])
                ->andFilterWhere(['status' => $this->status]);

            if ('' !== $this->tag) {
                $query->allTagValues($this->tag);
            }
        }

        return $data;
    }
}
