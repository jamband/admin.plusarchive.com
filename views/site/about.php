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
 */

$this->title = 'About - '.app()->name;
?>
<div class="row">
    <div class="col-xs-12 col-sm-1"></div>
    <div class="col-xs-12 col-sm-5">
        <?= $this->render('_description') ?>
    </div>
    <div class="col-xs-12 col-sm-5">
    </div>
    <div class="col-xs-12 col-sm-1"></div>
</div><!-- /.row -->
