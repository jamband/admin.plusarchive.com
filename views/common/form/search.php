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

use yii\helpers\Html;

?>
<?= Html::beginForm([''], 'get', ['class' => 'form-search pt-1', 'data-pjax' => true]) ?>
    <?= Html::textInput('search', $search, [
        'class' => 'form-control',
        'placeholder' => $placeholder,
    ]) ?>
<?= Html::endForm() ?>
