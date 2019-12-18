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
 * @var app\models\Label $model
 * @var yii\widgets\ActiveForm $form
 */

use app\models\LabelTag;
use yii\widgets\ActiveForm;

?>
<div class="row">
    <div class="col-md-5">
        <div class="alert alert-info">
            <i class="fas fa-info-circle"></i>
            <strong><?= h($model->getAttributeLabel('link')) ?></strong> が複数ある場合は改行で区切って入力してください。
        </div>
    </div>
    <div class="col-md-5 offset-md-1 order-md-first mb-3">
        <?php $form = ActiveForm::begin() ?>
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'country')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'link')->textarea(['rows' => 6]) ?>
            <?= $form->field($model, 'tagValues')->dropDownList(LabelTag::listData('name'), ['multiple' => true]) ?>
            <button class="btn btn-primary" type="submit"><?= $model->isNewRecord ? 'Create' : 'Update' ?></button>
        <?php ActiveForm::end() ?>
    </div>
</div>
<?= $this->render('/common/js/select-multiple', [
    'id' => '#label-tagvalues',
]) ?>
