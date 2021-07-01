<?php

/*
 * This file is part of the admin.plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $data
 * @var app\models\search\LabelSearch $search
 */

use app\components\ActionColumn;
use app\models\LabelTag;
use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = 'Admin Labels - '.app()->name;
?>
<?php Pjax::begin() ?>
    <?= $this->render('/common/nav/admin', [
        'total' => $data->totalCount,
        'enableCreate' => true,
    ]) ?>
    <?= GridView::widget([
        'id' => 'grid-view-label',
        'dataProvider' => $data,
        'filterModel' => $search,
        'columns' => [
            [
                'attribute' => 'name',
                'format' => 'raw',
                'value' => function ($data) {
                    return formatter()->asUrlWithText($data->url, $data->name);
                },
            ],
            [
                'attribute' => 'country',
                'filter' => $search::listData('country'),
                'filterInputOptions' => ['class' => 'form-select'],
            ],
            [
                'attribute' => 'link',
                'format' => 'raw',
                'value' => function ($data) {
                    return formatter()->asBrandIconLink($data->link, "\n", [
                        'class' => 'text-body',
                    ]);
                },
            ],
            [
                'attribute' => 'tag',
                'value' => function ($data) {
                    return formatter()->asTagValues($data->tagValues);
                },
                'filter' => LabelTag::listData('name'),
                'filterInputOptions' => ['class' => 'form-select'],
            ],
            'created_at:datetime',
            'updated_at:datetime',
            [
                'class' => ActionColumn::class,
                'buttonOptions' => ['class' => 'text-body'],
            ],
        ],
    ]) ?>
    <?= $this->render('/common/pagination', ['pagination' => $data->pagination]) ?>
<?php Pjax::end() ?>
