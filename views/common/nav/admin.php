<?php

/**
 * @var yii\web\View $this
 * @var bool $enableCreate
 * @var int $total
 */

?>
<div class="text-center mb-2">
    <?= $this->render('/common/nav/base') ?>
    <div class="d-inline-block dropdown">
        <a id="menu-action" class="tag" href="#" data-bs-toggle="dropdown">
            <?= ucfirst(app()->controller->action->id).': '.number_format($total) ?>
            <i class="fas fa-angle-down fa-fw"></i>
        </a>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="<?= url(['admin']) ?>" data-pjax="0">Admin</a>
            <?php if ($enableCreate): ?>
                <a class="dropdown-item" href="<?= url(['create']) ?>" data-pjax="0">Create</a>
            <?php endif ?>
        </div>
    </div>
</div>
