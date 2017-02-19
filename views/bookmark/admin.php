<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/* @var $this yii\web\View */
/* @var $search app\models\search\BookmarkSearch */
/* @var $data yii\data\ActiveDataProvider */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = 'Admin Bookmarks - '.app()->name;
?>
<?php Pjax::begin() ?>
    <?= $this->render('/common/nav/admin', [
        'totalCount' => $data->totalCount,
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
                'attribute' => 'link',
                'format' => ['snsIconLink', null, [], [
                    'rel' => 'noopener',
                    'target' => '_blank',
                ]],
            ],
            'tagValues',
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return h($model->statusText);
                },
                'filter' => $search::STATUS_DATA,
            ],
            'created_at:datetime',
            'updated_at:datetime',
            ['class' => app\components\ActionColumn::class],
        ],
    ]) ?>
    <?= $this->render('/common/pagination', ['pagination' => $data->pagination]) ?>
<?php Pjax::end() ?>
