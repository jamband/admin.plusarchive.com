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
<?= Html::beginForm([''], 'get', ['class' => 'form-search', 'data-pjax' => true]) ?>
    <div class="form-group has-feedback">
        <?= Html::textInput('search', $search, [
            'class' => 'form-control',
            'placeholder' => $placeholder,
        ]) ?>
        <button class="btn btn-default form-control-feedback" type="submit"><i class="fa fa-search"></i></button>
    </div>
<?= Html::endForm() ?>
