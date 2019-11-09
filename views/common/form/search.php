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
 * @var string $search
 * @var string $placeholder
 */

?>
<form class="form-search pt-1" action="<?= url(['']) ?>" method="get" data-pjax>
    <input class="form-control" type="text" name="search" placeholder="<?= $placeholder ?>" value="<?= $search ?>">
</form>
