<?php

/**
 * @var yii\data\pagination $pagination
 */

use yii\helpers\Html;
use yii\widgets\LinkPager;

?>
<?= LinkPager::widget(['pagination' => $pagination]) ?>
<div class="pagination-info text-center">
    <?= Html::encode(($pagination->page + 1).'/'.$pagination->pageCount) ?>
</div>
