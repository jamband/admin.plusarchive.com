<?php

/**
 * @var $this yii\web\View
 * @var $model app\models\Store
 */

$this->title = "Update Store: $model->name - ".app()->name;
?>
<?= $this->render('/common/nav/update', ['model' => $model]) ?>
<?= $this->render('_form', ['model' => $model]) ?>
