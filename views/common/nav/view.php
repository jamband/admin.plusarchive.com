<?php

/**
 * @var yii\web\View $this
 * @var yii\db\ActiveRecord $model
 */

use yii\helpers\Url;

?>
<div class="text-center mb-2">
    <?= $this->render('/common/nav/base') ?>
    <div class="d-inline-block dropdown">
        <a id="menu-action" class="tag" href="#" data-bs-toggle="dropdown">
            <?= ucfirst(Yii::$app->controller->action->id) ?>
            <i class="fas fa-fw fa-sm fa-angle-down"></i>
        </a>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="<?= Url::to(['admin']) ?>">Admin</a>
            <a class="dropdown-item" href="<?= Url::to(['create']) ?>">Create</a>
            <a class="dropdown-item" href="<?= Url::to(['update', 'id' => $model->id]) ?>">Update</a>
            <a class="dropdown-item" href="<?= Url::to(['delete', 'id' => $model->id]) ?>" data-confirm="Are you sure?" data-method="post">Delete</a>
        </div>
    </div>
</div>
