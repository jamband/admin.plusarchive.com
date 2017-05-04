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
 * @var yii\data\ActiveDataProvider $data
 * @var app\models\search\PlaylistSearch $search
 */

use app\components\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

$this->title = 'Admin Playlists - '.app()->name;
?>
<?php Pjax::begin() ?>
    <?= $this->render('/common/nav/admin', [
        'total' => $data->totalCount,
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
                    return Html::a(h($data->title), h($data->url), [
                        'class' => 'external-link',
                        'rel' => 'noopener',
                        'target' => '_blank',
                    ]);
                },
            ],
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return $model->statusText;
                },
                'filter' => $search::STATUSES,
            ],
            [
                'attribute' => 'provider',
                'value' => function ($model) {
                    return $model->providerText;
                },
                'filter' => $search::PROVIDERS,
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
