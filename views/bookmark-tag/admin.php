<?php

/**
 * @var yii\web\View $this
 * @var app\models\search\BookmarkTagSearch $search
 * @var yii\data\ActiveDataProvider $data
 */

use app\components\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = 'Admin BookmarkTags - '.app()->name;
?>
<?php Pjax::begin() ?>
    <?= $this->render('/common/nav/admin', [
        'total' => $data->totalCount,
        'enableCreate' => false,
    ]) ?>
    <?= GridView::widget([
        'id' => 'grid-view-bookmark-tag',
        'dataProvider' => $data,
        'filterModel' => $search,
        'columns' => [
            'name',
            'frequency',
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
