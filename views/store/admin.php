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
/* @var $data yii\data\ActiveDataProvider */
/* @var $search app\models\search\StoreSearch */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = 'Admin Stores - '.app()->name;
?>
<?php Pjax::begin() ?>
    <?= $this->render('/common/nav/admin', [
        'totalCount' => $data->totalCount,
    ]) ?>
    <?= GridView::widget([
        'id' => 'grid-view-store',
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
            'created_at:datetime',
            'updated_at:datetime',
            ['class' => app\components\ActionColumn::class],
        ],
    ]) ?>
<?php Pjax::end() ?>
