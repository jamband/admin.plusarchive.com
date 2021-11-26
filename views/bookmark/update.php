<?php

/**
 * @var yii\web\View $this
 * @var app\models\Bookmark $model
 */

$this->title = "Update Bookmark: $model->name - ".app()->name;
?>
<?= $this->render('/common/nav/update', ['model' => $model]) ?>
<?= $this->render('_form', ['model' => $model]) ?>
