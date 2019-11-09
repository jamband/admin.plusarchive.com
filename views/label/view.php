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
        [
            'attribute' => 'url',
            'format' => ['url', [
                'rel' => 'noopener',
                'target' => '_blank',
            ]],
        ],
        [
            'attribute' => 'link',
            'format' => ['brandIconLink', null, [
                'rel' => 'noopener',
                'target' => '_blank',
            ]],
        ],
        'tagValues:tagValues',
        'created_at:datetime',
        'updated_at:datetime',
    ],
]) ?>
