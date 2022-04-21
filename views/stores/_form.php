<?php

/**
 * @var yii\web\View $this
 * @var app\models\Store $model
 * @var yii\widgets\ActiveForm $form
 */

use app\models\StoreTag;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<div class="row">
    <div class="col-md-5">
        <div class="mt-2 mb-3 text-info">
            <i class="fas fa-info-circle"></i>
            <strong><?= Html::encode($model->getAttributeLabel('link')) ?></strong>
            が複数ある場合は改行で区切って入力してください。
        </div>
    </div>
    <div class="col-md-5 offset-md-1 order-md-first mb-3">
        <?php $form = ActiveForm::begin() ?>
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'country')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'link')->textarea(['rows' => 6]) ?>
            <?= $form->field($model, 'tagValues')->dropDownList(StoreTag::listData('name'), ['multiple' => true]) ?>
            <button class="btn btn-primary" type="submit"><?= $model->isNewRecord ? 'Create' : 'Update' ?></button>
        <?php ActiveForm::end() ?>
    </div>
</div>
<?= $this->render('/common/js/select-multiple', [
    'id' => '#store-tagvalues',
]) ?>
