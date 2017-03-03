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
 * @var yii\data\pagination $pagination
 */

use yii\widgets\LinkPager;

?>
<?= LinkPager::widget(['pagination' => $pagination]) ?>
<div class="text-center">
    <div class="pagination-info">
        <?= h(($pagination->page + 1).'/'.$pagination->pageCount) ?>
    </div>
</div>
