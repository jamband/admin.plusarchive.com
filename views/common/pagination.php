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
 * @var yii\data\pagination $pagination
 */

use yii\widgets\LinkPager;

?>
<?= LinkPager::widget(['pagination' => $pagination]) ?>
<div class="pagination-info text-center">
    <?= h(($pagination->page + 1).'/'.$pagination->pageCount) ?>
</div>
