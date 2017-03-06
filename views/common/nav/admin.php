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
 * @var bool $enableCreate
 * @var int $total
 * @var yii\web\Controller $context
 */

use yii\helpers\Html;

if (!isset($enableCreate)) {
    $enableCreate = true;
}
$context = $this->context;
?>
<div class="text-center">
    <?= $this->render('/common/nav/base') ?>

    <span class="dropdown">
        <?= Html::a(ucfirst($context->action->id).': '.number_format($total), '#', [
            'id' => 'menu-action',
            'class' => 'dropdown-toggle dropdown-hover label label-default',
            'data-toggle' => 'dropdown',
        ]) ?>
        <ul class="dropdown-menu">
            <li><a href="<?= url(['admin']) ?>" data-pjax="0">Admin</a></li>
            <?php if ($enableCreate): ?>
                <li><a href="<?= url(['create']) ?>" data-pjax="0">Create</a></li>
            <?php endif ?>
        </ul>
    </span><!-- /.dropdown -->
</div>
<p class="clearfix"></p>
