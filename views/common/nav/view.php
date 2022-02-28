<?php

/**
 * @var yii\web\View $this
 * @var yii\db\ActiveRecord $model
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
            <a class="dropdown-item" href="<?= url(['create']) ?>">Create</a>
            <a class="dropdown-item" href="<?= url(['update', 'id' => $model->id]) ?>">Update</a>
            <a class="dropdown-item" href="<?= url(['delete', 'id' => $model->id]) ?>" data-confirm="Are you sure?" data-method="post">Delete</a>
        </div>
    </div>
</div>
