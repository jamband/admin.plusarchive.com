<?php

/**
 * @var yii\web\View $this
 * @var string $licenses
 */

use yii\helpers\Html;

$this->title = 'Third-Party Licenses - '.Yii::$app->name;
?>
<div class="row">
    <div class="col-lg-8 offset-lg-1">
        <h1>Third-Party Licenses</h1>
        <?= nl2br(Html::encode($licenses)) ?>
    </div>
    <div class="col-lg-2">
    </div>
</div>
