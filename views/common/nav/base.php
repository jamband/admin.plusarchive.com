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

use yii\helpers\Html;
use yii\helpers\Inflector;

?>
<span class="dropdown">
    <?= Html::a(Inflector::id2camel($this->context->id).' <i class="fa fa-fw fa-angle-down"></i>', '#', [
        'id' => 'menu-controller',
        'class' => 'dropdown-toggle dropdown-hover label label-default',
        'data-toggle' => 'dropdown',
    ]) ?>
    <ul class="dropdown-menu">
        <li><a data-pjax="0" href="<?= url(['/track/admin']) ?>">Track</a></li>
        <li><a data-pjax="0" href="<?= url(['/track-genre/admin']) ?>">TrackGenre</a></li>
        <li><a data-pjax="0" href="<?= url(['/playlist/admin']) ?>">Playlist</a></li>
        <li><a data-pjax="0" href="<?= url(['/playlist-item/admin']) ?>">PlaylistItem</a></li>
        <li><a data-pjax="0" href="<?= url(['/label/admin']) ?>">Label</a></li>
        <li><a data-pjax="0" href="<?= url(['/label-tag/admin']) ?>">LabelTag</a></li>
        <li><a data-pjax="0" href="<?= url(['/store/admin']) ?>">Store</a></li>
        <li><a data-pjax="0" href="<?= url(['/store-tag/admin']) ?>">StoreTag</a></li>
        <li><a data-pjax="0" href="<?= url(['/bookmark/admin']) ?>">Bookmark</a></li>
        <li><a data-pjax="0" href="<?= url(['/bookmark-tag/admin']) ?>">BookmarkTag</a></li>
    </ul>
</span><!-- /.dropdown -->
