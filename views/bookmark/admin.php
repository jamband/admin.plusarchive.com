<?php

/**
 * @var yii\web\View $this
 * @var app\models\search\BookmarkSearch $search
 * @var yii\data\ActiveDataProvider $data
 */

use app\components\ActionColumn;
use app\models\BookmarkTag;
use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = 'Admin Bookmarks - '.app()->name;
?>
<?php Pjax::begin() ?>
    <?= $this->render('/common/nav/admin', [
        'total' => $data->totalCount,
        'enableCreate' => true,
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
                'filter' => BookmarkTag::listData('name'),
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
