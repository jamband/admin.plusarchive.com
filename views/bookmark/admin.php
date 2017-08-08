<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * @var yii\web\View $this
 * @var app\models\search\BookmarkSearch $search
 * @var yii\data\ActiveDataProvider $data
 */

use app\components\ActionColumn;
use app\models\BookmarkTag;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = 'Admin Bookmarks - '.app()->name;
?>
<?php Pjax::begin() ?>
    <?= $this->render('/common/nav/admin', [
        'total' => $data->totalCount,
    ]) ?>
    <?= GridView::widget([
        'id' => 'grid-view-bookmark',
        'dataProvider' => $data,
        'filterModel' => $search,
        'columns' => [
            [
                'attribute' => 'name',
                'format' => 'raw',
                'value' => function ($data) {
                    return Html::a(h($data->name), h($data->url), [
                        'class' => 'external-link',
                        'rel' => 'noopener',
                        'target' => '_blank',
                    ]);
                },
            ],
            [
                'attribute' => 'country',
                'filter' => array_combine($countries = $search::getCountries(), $countries),
            ],
            [
                'attribute' => 'link',
                'format' => ['snsIconLink', null, [], [
                    'rel' => 'noopener',
                    'target' => '_blank',
                ]],
            ],
            [
                'attribute' => 'tag',
                'value' => 'tagValues',
                'filter' => array_combine($tags = BookmarkTag::getNames()->column(), $tags),
            ],
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return h($model->statusText);
                },
                'filter' => $search::STATUSES,
            ],
            'created_at:datetime',
            'updated_at:datetime',
            ['class' => ActionColumn::class],
        ],
    ]) ?>
    <?= $this->render('/common/pagination', ['pagination' => $data->pagination]) ?>
<?php Pjax::end() ?>
