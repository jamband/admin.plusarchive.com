<?php

/**
 * @var yii\web\View $this
 * @var app\models\Bookmark $model
 */

$this->title = 'Create Bookmark - '.Yii::$app->name;
?>
<?= $this->render('/common/nav/create') ?>
<?= $this->render('_form', ['model' => $model]) ?>
