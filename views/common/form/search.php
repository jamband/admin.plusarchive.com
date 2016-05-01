<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/* @var $this yii\web\View */
/* @var $search string */
/* @var $placeholder string */

use yii\helpers\Html;

?>
<?= Html::beginForm([''], 'get', ['data-pjax' => true]) ?>
    <div id="input-search" class="input-group">
        <?= Html::textInput('search', $search, [
            'class' => 'form-control',
            'placeholder' => $placeholder,
        ]) ?>
        <div class="input-group-btn">
            <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
        </div>
    </div>
<?= Html::endForm() ?>

