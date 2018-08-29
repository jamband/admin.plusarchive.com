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
 */

use yii\helpers\Html;

?>
<div class="text-center mb-2">
    <?= $this->render('/common/nav/base') ?>
    <span class="dropdown">
        <?= Html::a(ucfirst(app()->controller->action->id).' <i class="fas fa-fw fa-angle-down"></i>', '#', [
            'id' => 'menu-action',
            'class' => 'dropdown-toggle badge badge-secondary',
            'data-toggle' => 'dropdown',
        ]) ?>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="<?= url(['admin']) ?>">Admin</a>
        </div>
    </span>
</div>
