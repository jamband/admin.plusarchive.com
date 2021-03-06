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
 * @var string $name
 * @var string $message
 * @var Exception $exception
 */

$this->title = "$name - ".app()->name;
?>
<div class="row">
    <div class="col-lg-8 offset-lg-1">
        <h1><?= h($this->title) ?></h1>
        <i class="fas fa-info-circle"></i> <?= nl2br(h($message)) ?>
    </div>
    <div class="col-lg-2">
    </div>
</div>
