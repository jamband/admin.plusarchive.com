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
/* @var $model app\models\Track */
/* @var $form yii\widgets\ActiveForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<div class="row">
    <div class="col-xs-12 col-sm-1"></div>
    <div class="col-xs-12 col-sm-5">
        <?php $form = ActiveForm::begin() ?>
            <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'status')->dropDownList($model::STATUS_DATA) ?>
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'image')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'tagValues') ?>
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-primary']) ?>
            </div>
        <?php ActiveForm::end() ?>
    </div>
    <div class="col-xs-12 col-sm-5">
        <div class="alert alert-info">
            <i class="fa fa-info-circle"></i>
            <?= h($model->getAttributeLabel('title')) ?> と
            <?= h($model->getAttributeLabel('image')) ?> は
            <?= h($model->getAttributeLabel('url')) ?> の値から自動取得されます。
            もし独自のものに変更したい場合は、フォームから直接入力することもできます。
        </div>
    </div>
    <div class="col-xs-12 col-sm-1"></div>
</div><!-- /.row -->

<?= $this->render('/common/js/selectize', [
    'id' => '#track-tagvalues',
    'url' => url(['track-genre/list']),
]) ?>
