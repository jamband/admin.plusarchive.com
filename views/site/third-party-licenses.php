<?php

/**
 * @var yii\web\View $this
 * @var string $licenses
 */

$this->title = 'Third-Party Licenses - '.app()->name;
?>
<div class="row">
    <div class="col-lg-8 offset-lg-1">
        <h1>Third-Party Licenses</h1>
        <?= nl2br(h($licenses)) ?>
    </div>
    <div class="col-lg-2">
    </div>
</div>
