<?php

/**
 * @var yii\web\View $this
 * @var app\models\search\MusicGenreSearch $search
 * @var yii\data\ActiveDataProvider $data
 */

use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;

$this->title = 'Admin MusicGenres - '.Yii::$app->name;
?>
<?php Pjax::begin() ?>
    <?= $this->render('/common/nav/admin', [
        'total' => $data->totalCount,
        'enableCreate' => false,
    ]) ?>
    <?= GridView::widget([
        'id' => 'grid-view-music-genres',
        'dataProvider' => $data,
        'filterModel' => $search,
        'columns' => [
            'name',
            'frequency',
            'created_at:datetime',
            'updated_at:datetime',
            [
                'class' => ActionColumn::class,
                'visibleButtons' => ['view' => false],
                'urlCreator' => fn(string $action, mixed $model, mixed $key): string =>
                    Url::toRoute('/musicGenres/'.$action.'/'.$key),
            ],
        ],
    ]); ?>
    <?= $this->render('/common/pagination', ['pagination' => $data->pagination]) ?>
<?php Pjax::end() ?>
