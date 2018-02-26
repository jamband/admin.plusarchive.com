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
    <div class="col-md-5 offset-md-1">
        <?= $this->render('_description') ?>
    </div>
    <div class="col-md-5">
    </div>
</div>
