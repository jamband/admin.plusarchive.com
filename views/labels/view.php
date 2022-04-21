<?php

/**
 * @var yii\web\View $this
 * @var app\models\Label $model
 */

use yii\widgets\DetailView;

$this->title = "View Label: $model->name - ".Yii::$app->name;
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
                return Yii::$app->formatter->asBrandIconLink($data->link, options: [
                    'class' => 'me-1 tag',
                ]);
            },
        ],
        'tagValues:tagValues',
        'created_at:datetime',
        'updated_at:datetime',
    ],
]) ?>
