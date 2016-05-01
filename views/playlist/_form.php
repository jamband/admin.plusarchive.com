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
/* @var $model app\models\Playlist */
/* @var $form yii\widgets\ActiveForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<div class="row">
    <div class="col-xs-12 col-sm-1"></div>
    <div class="col-xs-12 col-sm-5">
        <?php $form = ActiveForm::begin() ?>
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'status')->DropdownList($model::STATUS_DATA) ?>
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-primary']) ?>
            </div>
        <?php ActiveForm::end() ?>
    </div>
    <div class="col-xs-12 col-sm-5"></div>
    <div class="col-xs-12 col-sm-1"></div>
</div><!-- /.row -->
