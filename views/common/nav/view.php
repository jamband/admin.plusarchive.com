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
 * @var yii\db\ActiveRecord $model
 * @var yii\web\Controller $context
 */

use yii\helpers\Html;

$context = $this->context;
?>
<div class="text-center mb-2">
    <?= $this->render('/common/nav/base') ?>
    <span class="dropdown">
        <?= Html::a(ucfirst($context->action->id).' <i class="fas fa-fw fa-angle-down"></i>', '#', [
            'id' => 'menu-action',
            'class' => 'dropdown-toggle badge badge-secondary',
            'data-toggle' => 'dropdown',
        ]) ?>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="<?= url(['admin']) ?>">Admin</a>
            <a class="dropdown-item" href="<?= url(['create']) ?>">Create</a>
            <a class="dropdown-item" href="<?= url(['update', 'id' => $model->id]) ?>">Update</a>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'dropdown-item',
                'data-confirm' => 'Are you sure you want to delete this item?',
                'data-method' => 'post',
            ]) ?>
        </div>
    </span>
</div>
