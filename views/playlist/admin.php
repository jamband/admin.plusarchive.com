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
/* @var $search app\models\search\PlaylistSearch */

use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = 'Admin Playlists - '.app()->name;
?>
<?php Pjax::begin() ?>
    <?= $this->render('/common/nav/admin', [
        'totalCount' => $data->totalCount,
    ]) ?>
    <?= GridView::widget([
        'dataProvider' => $data,
        'filterModel' => $search,
        'columns' => [
            'title',
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return $model->statusText;
                },
                'filter' => $search::STATUS_DATA,
            ],
            'created_at:datetime',
            'updated_at:datetime',
            [
                'class' => app\components\ActionColumn::class,
                'template' => '{update} {delete}',
            ],
        ],
    ]) ?>
<?php Pjax::end() ?>
