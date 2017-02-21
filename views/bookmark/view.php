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
/* @var $model app\models\Bookmark */

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
        [
            'attribute' => 'url',
            'format' => ['url', [
                'class' => 'external-link',
                'rel' => 'noopener',
                'target' => '_blank',
            ]],
        ],
        'link:snsIconLink',
        'tagValues',
        [
            'attribute' => 'status',
            'value' => $model->statusText,
        ],
        'created_at:datetime',
        'updated_at:datetime',
    ],
]) ?>
