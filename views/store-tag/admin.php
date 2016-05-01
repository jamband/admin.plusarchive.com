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
/* @var $search app\models\search\StoreTagSearch */

use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = 'Admin StoreTags - '.app()->name;
?>
<?php Pjax::begin() ?>
    <?= $this->render('/common/nav/admin', [
        'totalCount' => $data->totalCount,
        'enableCreate' => false,
    ]) ?>
    <?= GridView::widget([
        'dataProvider' => $data,
        'filterModel' => $search,
        'columns' => [
            'name',
            'frequency',
            'created_at:datetime',
            'updated_at:datetime',
            [
                'class' => app\grid\ActionColumn::class,
                'template' => '{update} {delete}',
            ],
        ],
    ]) ?>
<?php Pjax::end() ?>
