<?php

/*
 * This file is part of the admin.plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var app\models\form\LoginForm $model
 */

use yii\widgets\ActiveForm;

$this->title = 'Login - '.app()->name;
?>
<div class="row">
    <div class="col-sm-6 col-md-5 offset-md-1">
        <h2>Log in</h2>
    </div>
    <div class="col-sm-6 col-md-5">
        <?php $form = ActiveForm::begin(['fieldConfig' => ['template' => "{label}\n{input}"]]) ?>
            <?= $form->errorSummary($model) ?>
            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'password')->passwordInput() ?>
            <?= $form->field($model, 'rememberMe')->checkbox() ?>
            <button class="btn btn-primary" type="submit">Login</button>
        <?php ActiveForm::end() ?>
    </div>
</div>
