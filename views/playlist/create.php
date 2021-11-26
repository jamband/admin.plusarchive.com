<?php

/**
 * @var yii\web\View $this
 * @var app\models\Playlist $model
 */

$this->title = 'Create Playlist - '.app()->name;
?>
<?= $this->render('/common/nav/create', ['model' => $model]) ?>
<?= $this->render('_form', ['model' => $model, 'action' => 'Create']); ?>
