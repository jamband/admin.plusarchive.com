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

$this->registerJs(<<<JS
$('.toast').toast('show');
JS
, $this::POS_END);

?>
<div role="alert" aria-live="assertive" aria-atomic="true" class="toast" data-delay="5000">
    <div class="d-flex">
        <div class="toast-body mr-auto font-weight-bold">
            <?= h(session()->getFlash('notification')) ?>
        </div>
        <button type="button" class="ml-2 mr-3 text-white close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
