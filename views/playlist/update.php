<?php

/**
 * @var yii\web\View $this
 * @var app\models\Playlist $model
 */

$this->title = "Update Playlist: $model->title - ".app()->name;
?>
<?= $this->render('/common/nav/update', ['model' => $model]) ?>
<?= $this->render('_form', ['model' => $model, 'action' => 'Update']); ?>
