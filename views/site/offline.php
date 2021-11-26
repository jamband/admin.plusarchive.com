<?php

/**
 * @var yii\web\View $this
 */

$this->title = 'Currently in maintenance - '.app()->name;
?>
<div class="row">
    <div class="col-lg-5 offset-lg-1 mb-4">
        <h1>Currently in maintenance</h1>
        Please wait until the restoration. Thank you.<br>
    </div>
    <div class="col-lg-5">
        <?= $this->render('_description') ?>
    </div>
</div>
