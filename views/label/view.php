<?php

/**
 * @var yii\web\View $this
 * @var app\models\Label $model
 */

use yii\widgets\DetailView;

$this->title = "View Label: $model->name - ".app()->name;
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
                return formatter()->asBrandIconLink($data->link, "\n", [
                    'class' => 'text-body',
                ]);
            },
        ],
        'tagValues:tagValues',
        'created_at:datetime',
        'updated_at:datetime',
    ],
]) ?>
