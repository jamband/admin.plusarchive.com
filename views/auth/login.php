<?php

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var app\models\form\LoginForm $model
 */

use yii\widgets\ActiveForm;

$this->title = 'Login - '.Yii::$app->name;
?>
<div class="row">
    <div class="col-md-8 col-lg-6 offset-md-2 offset-lg-3">
        <h1>Log in</h1>
        <?php $form = ActiveForm::begin(['fieldConfig' => ['template' => "{label}\n{input}"]]) ?>
        <?= $form->errorSummary($model) ?>
        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
        <?= $form->field($model, 'password')->passwordInput() ?>
        <?= $form->field($model, 'rememberMe')->checkbox() ?>
        <button class="btn btn-primary" type="submit">Login</button>
        <?php ActiveForm::end() ?>
    </div>
</div>
