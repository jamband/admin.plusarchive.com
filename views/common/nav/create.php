<?php

/**
 * @var yii\web\View $this
 */

?>
<div class="text-center mb-2">
    <?= $this->render('/common/nav/base') ?>
    <div class="d-inline-block dropdown">
        <a id="menu-action" class="tag" href="#" data-bs-toggle="dropdown">
            <?= ucfirst(app()->controller->action->id) ?>
            <i class="fas fa-fw fa-angle-down"></i>
        </a>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="<?= url(['admin']) ?>">Admin</a>
        </div>
    </div>
</div>
