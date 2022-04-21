<?php

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $data
 * @var app\models\search\StoreSearch $search
 */

use app\models\StoreTag;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;

$this->title = 'Admin Stores - '.Yii::$app->name;
?>
<?php Pjax::begin() ?>
    <?= $this->render('/common/nav/admin', [
        'total' => $data->totalCount,
        'enableCreate' => true,
    ]) ?>
    <?= GridView::widget([
        'id' => 'grid-view-stores',
        'dataProvider' => $data,
        'filterModel' => $search,
        'columns' => [
            [
                'attribute' => 'name',
                'format' => 'raw',
                'value' => function ($data) {
                    return Yii::$app->formatter->asUrlWithText($data->url, $data->name);
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
                    return Yii::$app->formatter->asBrandIconLink($data->link, options: [
                        'class' => 'me-1 tag',
                    ]);
                },
            ],
            [
                'attribute' => 'tag',
                'value' => function ($data) {
                    return Yii::$app->formatter->asTagValues($data->tagValues);
                },
                'filter' => StoreTag::listData('name'),
                'filterInputOptions' => ['class' => 'form-select'],
            ],
            'created_at:datetime',
            'updated_at:datetime',
            [
                'class' => ActionColumn::class,
                'urlCreator' => fn(string $action, mixed $model, mixed $key): string =>
                    Url::toRoute('/stores/'.$action.'/'.$key),
            ],
        ],
    ]) ?>
    <?= $this->render('/common/pagination', ['pagination' => $data->pagination]) ?>
<?php Pjax::end() ?>
