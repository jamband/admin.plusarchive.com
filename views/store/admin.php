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
 * @var app\models\search\StoreSearch $search
 */

use app\components\ActionColumn;
use app\models\StoreTag;
use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = 'Admin Stores - '.app()->name;
?>
<?php Pjax::begin() ?>
    <?= $this->render('/common/nav/admin', [
        'total' => $data->totalCount,
        'enableCreate' => true,
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
                    return formatter()->asUrlWithText($data->url, $data->name);
                },
            ],
            [
                'attribute' => 'country',
                'filter' => $search::listData('country'),
                'filterInputOptions' => ['class' => 'form-select'],
            ],
            'link:brandIconLink',
            [
                'attribute' => 'tag',
                'value' => function ($data) {
                    return formatter()->asTagValues($data->tagValues);
                },
                'filter' => Storetag::listData('name'),
                'filterInputOptions' => ['class' => 'form-select'],
            ],
            'created_at:datetime',
            'updated_at:datetime',
            ['class' => ActionColumn::class],
        ],
    ]) ?>
    <?= $this->render('/common/pagination', ['pagination' => $data->pagination]) ?>
<?php Pjax::end() ?>
