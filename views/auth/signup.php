<?php

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var app\models\form\LoginForm $model
 */

use yii\widgets\ActiveForm;

$this->title = 'Sign up - '.Yii::$app->name;
?>
<div class="row">
    <div class="col-md-8 col-lg-6 offset-md-2 offset-lg-3">
        <h1>Sign up</h1>
        <?php $form = ActiveForm::begin() ?>
            <?= $form->field($model, 'username') ?>
            <?= $form->field($model, 'email') ?>
            <?= $form->field($model, 'password')->passwordInput() ?>
            <button class="btn btn-primary" type="submit">Sign up</button>
        <?php ActiveForm::end() ?>
    </div>
</div>
