<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = "$name - ".app()->name;
?>
<h1><?= h($this->title) ?></h1>

<div class="alert alert-danger">
    <i class="fa fa-fw fa-info-circle"></i> <?= nl2br(h($message)) ?>
</div>
