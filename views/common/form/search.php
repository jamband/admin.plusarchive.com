<?php

/**
 * @var yii\web\View $this
 * @var string $search
 * @var string $placeholder
 */

?>
<form class="form-search pt-1" action="<?= url(['']) ?>" method="get" data-pjax>
    <input class="form-control" type="text" name="search" placeholder="<?= $placeholder ?>" value="<?= $search ?>">
</form>
