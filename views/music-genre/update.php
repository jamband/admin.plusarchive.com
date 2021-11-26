<?php

/**
 * @var yii\web\View $this
 * @var app\models\MusicGenre $model
 * @var yii\widgets\ActiveForm $form
 */

use yii\widgets\ActiveForm;

$this->title = "Update MusicGenre: $model->name - ".app()->name;
?>
<?= $this->render('/common/nav/update', ['model' => $model]) ?>

<div class="row">
    <div class="col-md-5">
    </div>
    <div class="col-md-5 offset-md-1 order-md-first mb-3">
        <?php $form = ActiveForm::begin() ?>
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            <button class="btn btn-primary" type="submit">Update</button>
        <?php ActiveForm::end() ?>
    </div>
</div>
