<?php

/**
 * @var yii\web\View $this
 * @var app\models\Track $model
 */

$this->title = "Update Track: $model->title - ".Yii::$app->name;
?>
<?= $this->render('/common/nav/update', ['model' => $model]) ?>
<?= $this->render('_form', ['model' => $model, 'action' => 'Update']) ?>
<?= $this->render('/common/js/select-multiple', ['id' => '#trackupdateform-tagvalues']) ?>
