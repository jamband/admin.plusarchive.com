<?php

/**
 * @var yii\web\View $this
 * @var app\models\Track $model
 */

$this->title = 'Create Track - '.app()->name;
?>
<?= $this->render('/common/nav/create') ?>
<?= $this->render('_form', ['model' => $model, 'action' => 'Create']) ?>
<?= $this->render('/common/js/select-multiple', ['id' => '#trackcreateform-tagvalues']) ?>
