<?php

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $data
 * @var app\models\search\PlaylistSearch $search
 */

use app\models\Music;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

$this->title = 'Admin Playlists - '.Yii::$app->name;
?>
<?php Pjax::begin() ?>
    <?= $this->render('/common/nav/admin', [
        'total' => $data->totalCount,
        'enableCreate' => true,
    ]) ?>
    <?= GridView::widget([
        'id' => 'grid-view-playlists',
        'dataProvider' => $data,
        'filterModel' => $search,
        'columns' => [
            [
                'attribute' => 'title',
                'format' => 'raw',
                'value' => function ($data) {
                    return Yii::$app->formatter->asUrlWithText($data->url, $data->title);
                },
            ],
            [
                'attribute' => 'provider',
                'value' => function ($model) {
                    return Html::encode($model->providerText);
                },
                'filter' => Music::PROVIDERS,
                'filterInputOptions' => ['class' => 'form-select'],
            ],
            'provider_key',
            'created_at:datetime',
            'updated_at:datetime',
            [
                'class' => ActionColumn::class,
                'visibleButtons' => ['view' => false],
                'urlCreator' => fn(string $action, mixed $model, mixed $key): string =>
                    Url::toRoute('/playlists/'.$action.'/'.$key),
            ],
        ],
    ]) ?>
    <?= $this->render('/common/pagination', ['pagination' => $data->pagination]) ?>
<?php Pjax::end() ?>
