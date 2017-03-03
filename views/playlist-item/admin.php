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
 * @var app\models\search\PlaylistItemSearch $search
 */

use app\models\Playlist;
use app\models\Track;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = 'Admin PlaylistItems - '.app()->name;
?>
<?php Pjax::begin() ?>
    <?= $this->render('/common/nav/admin', [
        'total' => $data->totalCount,
    ]) ?>
    <?= GridView::widget([
        'id' => 'grid-view-playlist-item',
        'dataProvider' => $data,
        'filterModel' => $search,
        'columns' => [
            [
                'attribute' => 'playlist',
                'value' => 'playlist.title',
                'filter' => Playlist::getListData(),
            ],
            [
                'attribute' => 'status',
                'value' => 'playlist.statusText',
                'filter' => Playlist::STATUS_DATA,
            ],
            [
                'attribute' => 'title',
                'format' => 'raw',
                'value' => function ($data) {
                    return Html::a(h($data->track->title), h($data->track->url), [
                        'class' => 'external-link',
                        'rel' => 'noopener',
                        'target' => '_blank',
                    ]);
                },
            ],
            [
                'attribute' => 'provider',
                'value' => 'track.providerText',
                'filter' => Track::PROVIDER_DATA,
            ],
            'track_number',
            'created_at:datetime',
            'updated_at:datetime',
            [
                'class' => app\components\ActionColumn::class,
                'template' => '{sort} {delete}',
                'buttons' => [
                    'sort' => function ($url, $model) {
                        return Html::a('<i class="fa fa-fw fa-sort"></i>', ['sort', 'playlist_id' => $model->playlist_id], [
                            'data-pjax' => '0',
                        ]);
                    },
                ],
            ],
        ],
    ]) ?>
    <?= $this->render('/common/pagination', ['pagination' => $data->pagination]) ?>
<?php Pjax::end() ?>
