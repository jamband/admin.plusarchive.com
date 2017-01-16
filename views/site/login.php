<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model app\models\form\LoginForm */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'Login - '.app()->name;
?>
<div class="row">
    <div class="col-xs-12 col-sm-1"></div>
    <div class="col-xs-12 col-sm-5">
        <h2>Log in</h2>
    </div>
    <div class="col-xs-12 col-sm-5">
        <?php $form = ActiveForm::begin(['fieldConfig' => ['template' => "{label}\n{input}"]]) ?>
            <?= $form->errorSummary($model) ?>
            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'password')->passwordInput() ?>
            <?= $form->field($model, 'rememberMe')->checkbox() ?>
            <div class="form-group">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary']) ?>
            </div>
        <?php ActiveForm::end() ?>
    </div>
    <div class="col-xs-12 col-sm-1"></div>
</div><!-- /.row -->
