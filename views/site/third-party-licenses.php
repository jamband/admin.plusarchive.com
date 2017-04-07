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
 * @var string $licenses
 */

$this->title = 'Third-Party Licenses - '.app()->name;
?>
<div class="row">
    <div class="col-xs-12 col-sm-1"></div>
    <div class="col-xs-12 col-sm-10">
        <h2>Third-Party Licenses</h2>
        <?= nl2br(h($licenses)) ?>
    </div>
    <div class="col-xs-12 col-sm-1"></div>
</div><!-- /.row -->
