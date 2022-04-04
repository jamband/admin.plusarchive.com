<?php

/**
 * @var yii\web\View $this
 * @var app\models\Label $model
 */

$this->title = 'Create Label - '.Yii::$app->name;
?>
<?= $this->render('/common/nav/create', ['model' => $model]) ?>
<?= $this->render('_form', ['model' => $model]); ?>
