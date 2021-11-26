<?php

/**
 * @var yii\web\View $this
 * @var app\models\Store $model
 */

$this->title = 'Create Store - '.app()->name;
?>
<?= $this->render('/common/nav/create') ?>
<?= $this->render('_form', ['model' => $model]) ?>
