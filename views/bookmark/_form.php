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
 * @var app\models\Bookmark $model
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-5 col-md-offset-1">
        <?php $form = ActiveForm::begin() ?>
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'country')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'link')->textarea(['rows' => 6]) ?>
            <?= $form->field($model, 'tagValues') ?>
            <?= $form->field($model, 'status')->DropdownList($model::STATUSES) ?>
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-primary']) ?>
            </div>
        <?php ActiveForm::end() ?>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-5">
        <div class="alert alert-info">
            <i class="fa fa-info-circle"></i>
            <strong><?= h($model->getAttributeLabel('link')) ?></strong> が複数ある場合は改行で区切って入力してください。
        </div>
    </div>
</div><!-- /.row -->

<?= $this->render('/common/js/selectize', [
    'id' => '#bookmark-tagvalues',
    'url' => url(['bookmark-tag/list']),
]) ?>
