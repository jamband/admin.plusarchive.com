<?php

/**
 * @var yii\web\View $this
 * @var string $name
 * @var string $message
 * @var Exception $exception
 */

use yii\helpers\Html;

$this->title = "$name - ".Yii::$app->name;
?>
<div class="row">
    <div class="col-lg-8 offset-lg-1">
        <h1><?= Html::encode($this->title) ?></h1>
        <i class="fas fa-info-circle"></i> <?= nl2br(Html::encode($message)) ?>
    </div>
    <div class="col-lg-2">
    </div>
</div>
