<?php

/**
 * @var yii\web\View $this
 * @var app\models\Track $model
 * @var yii\widgets\ActiveForm $form
 * @var string $action
 */

use app\models\MusicGenre;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<div class="row">
    <div class="col-md-5">
        <div class="mt-2 mb-3 text-info">
            <i class="fas fa-info-circle"></i>
            <?= Html::encode($model->getAttributeLabel('title')) ?> と
            <?= Html::encode($model->getAttributeLabel('image')) ?> は
            <?= Html::encode($model->getAttributeLabel('url')) ?> の値から自動取得されます。
            もし独自のものに変更したい場合は、フォームから直接入力することもできます。
        </div>
    </div>
    <div class="col-md-5 offset-md-1 order-md-first mb-3">
        <?php $form = ActiveForm::begin() ?>
            <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'image')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'urge')->radioList([0 => 'off', 1 => 'on']) ?>
            <?= $form->field($model, 'tagValues')->dropdownList(MusicGenre::listData('name'), ['multiple' => true]) ?>
            <button class="btn btn-primary" type="submit"><?= Html::encode($action) ?></button>
        <?php ActiveForm::end() ?>
    </div>
</div>
