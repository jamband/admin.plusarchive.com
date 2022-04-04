<?php

/**
 * @var yii\web\View $this
 * @var string $search
 * @var string $placeholder
 */

use yii\helpers\Url;

?>
<form class="form-search pt-1" action="<?= Url::to(['']) ?>" method="get" data-pjax>
    <input class="form-control" type="text" name="search" placeholder="<?= $placeholder ?>" value="<?= $search ?>">
</form>
