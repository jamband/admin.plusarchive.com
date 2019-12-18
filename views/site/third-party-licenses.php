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
 * @var string $licenses
 */

$this->title = 'Third-Party Licenses - '.app()->name;
?>
<div class="row">
    <div class="col-md-11 offset-md-1">
        <h2>Third-Party Licenses</h2>
        <?= nl2br(h($licenses)) ?>
    </div>
</div>
