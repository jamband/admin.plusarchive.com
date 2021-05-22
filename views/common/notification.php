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
var toast = new Toast(document.querySelector('.toast'));
toast.show();
JS
, $this::POS_END);

?>
<div role="alert" aria-live="assertive" aria-atomic="true" class="toast" data-bs-delay="5000">
    <div class="d-flex">
        <div class="toast-body fw-bold">
            <?= h(session()->getFlash('notification')) ?>
        </div>
        <button type="button" class="me-2 m-auto btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
</div>
