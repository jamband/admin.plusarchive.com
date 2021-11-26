<?php

/**
 * @var yii\web\View $this
 * @var app\models\Playlist $model
 * @var yii\widgets\ActiveForm $form
 * @var string $action
 */

use yii\widgets\ActiveForm;

?>
<div class="row">
    <div class="col-md-5">
    </div>
    <div class="col-md-5 offset-md-1 order-md-first mb-3">
        <?php $form = ActiveForm::begin() ?>
            <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'image')->textInput(['maxlength' => true]) ?>
            <button class="btn btn-primary" type="submit"><?= h($action) ?></button>
        <?php ActiveForm::end() ?>
    </div>
</div>
