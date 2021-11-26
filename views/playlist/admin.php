<?php

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $data
 * @var app\models\search\PlaylistSearch $search
 */

use app\components\ActionColumn;
use app\models\Playlist;
use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = 'Admin Playlists - '.app()->name;
?>
<?php Pjax::begin() ?>
    <?= $this->render('/common/nav/admin', [
        'total' => $data->totalCount,
        'enableCreate' => true,
    ]) ?>
    <?= GridView::widget([
        'id' => 'grid-view-playlist',
        'dataProvider' => $data,
        'filterModel' => $search,
        'columns' => [
            [
                'attribute' => 'title',
                'format' => 'raw',
                'value' => function ($data) {
                    return formatter()->asUrlWithText($data->url, $data->title);
                },
            ],
            [
                'attribute' => 'provider',
                'value' => function ($model) {
                    return h($model->providerText);
                },
                'filter' => Playlist::PROVIDERS,
                'filterInputOptions' => ['class' => 'form-select'],
            ],
            'provider_key',
            'created_at:datetime',
            'updated_at:datetime',
            [
                'class' => ActionColumn::class,
                'template' => '{update} {delete}',
            ],
        ],
    ]) ?>
    <?= $this->render('/common/pagination', ['pagination' => $data->pagination]) ?>
<?php Pjax::end() ?>
