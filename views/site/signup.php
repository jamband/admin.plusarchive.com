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

$this->title = 'Sign up - '.app()->name;
?>
<div class="row">
    <div class="col-xs-12 col-sm-1"></div>
    <div class="col-xs-12 col-sm-5">
        <h2>Sign up</h2>
    </div>
    <div class="col-xs-12 col-sm-5">
        <?php $form = ActiveForm::begin() ?>
            <?= $form->field($model, 'username') ?>
            <?= $form->field($model, 'email') ?>
            <?= $form->field($model, 'password')->passwordInput() ?>
            <div class="form-group">
                <?= Html::submitButton('Sign up', ['class' => 'btn btn-primary']) ?>
            </div>
        <?php ActiveForm::end() ?>
    </div>
    <div class="col-xs-12 col-sm-1"></div>
</div><!-- /.row -->
