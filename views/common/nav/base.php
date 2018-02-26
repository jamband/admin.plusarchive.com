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
 * @var yii\web\Controller $context
 */

use yii\helpers\Html;
use yii\helpers\Inflector;

$context = $this->context;
?>
<span class="dropdown">
    <?= Html::a(Inflector::id2camel($context->id), '#', [
        'id' => 'menu-controller',
        'class' => 'dropdown-toggle badge badge-secondary',
        'data-toggle' => 'dropdown',
    ]) ?>
    <div class="dropdown-menu">
        <a class="dropdown-item" data-pjax="0" href="<?= url(['/track/admin']) ?>">Track</a>
        <a class="dropdown-item" data-pjax="0" href="<?= url(['/track-genre/admin']) ?>">TrackGenre</a>
        <a class="dropdown-item" data-pjax="0" href="<?= url(['/playlist/admin']) ?>">Playlist</a>
        <a class="dropdown-item" data-pjax="0" href="<?= url(['/label/admin']) ?>">Label</a>
        <a class="dropdown-item" data-pjax="0" href="<?= url(['/label-tag/admin']) ?>">LabelTag</a>
        <a class="dropdown-item" data-pjax="0" href="<?= url(['/store/admin']) ?>">Store</a>
        <a class="dropdown-item" data-pjax="0" href="<?= url(['/store-tag/admin']) ?>">StoreTag</a>
        <a class="dropdown-item" data-pjax="0" href="<?= url(['/bookmark/admin']) ?>">Bookmark</a>
        <a class="dropdown-item" data-pjax="0" href="<?= url(['/bookmark-tag/admin']) ?>">BookmarkTag</a>
    </div>
</span>
