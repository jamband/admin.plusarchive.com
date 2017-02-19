<?php

/* @pagination yii\data\pagination */

use yii\widgets\LinkPager;

?>
<?= LinkPager::widget(['pagination' => $pagination]) ?>
<div class="text-center">
    <div class="pagination-info">
        <?= h(($pagination->page + 1).'/'.$pagination->pageCount) ?>
    </div>
</div>
