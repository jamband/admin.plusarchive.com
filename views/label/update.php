<?php

/**
 * @var yii\web\View $this
 * @var app\models\Label $model
 */

$this->title = "Update Label: $model->name - ".Yii::$app->name;
?>
<?= $this->render('/common/nav/update', ['model' => $model]) ?>
<?= $this->render('_form', ['model' => $model]); ?>
