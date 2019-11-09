<?php

/*
 * This file is part of the plusarchive.com
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

$this->title = 'Sign up - '.app()->name;
?>
<div class="row">
    <div class="col-md-5 offset-md-1">
        <h2>Sign up</h2>
    </div>
    <div class="col-md-5">
        <?php $form = ActiveForm::begin() ?>
            <?= $form->field($model, 'username') ?>
            <?= $form->field($model, 'email') ?>
            <?= $form->field($model, 'password')->passwordInput() ?>
            <button class="btn btn-primary" type="submit">Sign up</button>
        <?php ActiveForm::end() ?>
    </div>
</div>
