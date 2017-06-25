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

$this->title = 'Currently in maintenance - '.app()->name;
?>
<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-5 col-md-offset-1">
        <h2>Currently in maintenance</h2>
        Please wait until the restoration. Thank you.<br>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-5">
        <?= $this->render('_description') ?>
    </div>
</div><!-- /.row -->
