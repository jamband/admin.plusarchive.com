<?php

/**
 * @var yii\data\pagination $pagination
 */

use yii\widgets\LinkPager;

?>
<?= LinkPager::widget(['pagination' => $pagination]) ?>
<div class="pagination-info text-center">
    <?= h(($pagination->page + 1).'/'.$pagination->pageCount) ?>
</div>
