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
 * @var app\models\TrackGenre $model
 * @var yii\widgets\ActiveForm $form
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = "Update TrackGenre: $model->name - ".app()->name;
?>
<?= $this->render('/common/nav/update', ['model' => $model]) ?>

<div class="row">
    <div class="col-md-5">
    </div>
    <div class="col-md-5 offset-md-1 order-md-first mb-3">
        <?php $form = ActiveForm::begin() ?>
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            <?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
        <?php ActiveForm::end() ?>
    </div>
</div>
