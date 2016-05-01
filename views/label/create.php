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
/* @var $model app\models\Label */

$this->title = 'Create Label - '.app()->name;
?>
<?= $this->render('/common/nav/create', ['model' => $model]) ?>
<?= $this->render('_form', ['model' => $model]); ?>
