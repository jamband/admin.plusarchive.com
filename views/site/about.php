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
 */

$this->title = 'About - '.app()->name;
?>
<div class="row">
    <div class="col-lg-8 offset-lg-1">
        <?= $this->render('_description') ?>
    </div>
    <div class="col-lg-2">
    </div>
</div>
