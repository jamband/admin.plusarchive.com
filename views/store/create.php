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
 * @var app\models\Store $model
 */

$this->title = 'Create Store - '.app()->name;
?>
<?= $this->render('/common/nav/create') ?>
<?= $this->render('_form', ['model' => $model]) ?>
