<?php

/**
 * @var yii\web\View $this
 * @var app\models\Bookmark $model
 */

use yii\widgets\DetailView;

$this->title = "View Bookmark: $model->name - ".app()->name;
?>
<?= $this->render('/common/nav/view', ['model' => $model]) ?>

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        'name',
        'country',
        'url:urlWithText',
        [
            'attribute' => 'link',
            'format' => 'raw',
            'value' => function ($data) {
                return formatter()->asBrandIconLink($data->link, options: [
                    'class' => 'me-1 tag',
                ]);
            }
        ],
        'tagValues:tagValues',
        'created_at:datetime',
        'updated_at:datetime',
    ],
]) ?>
