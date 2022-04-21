<?php

/**
 * @var yii\web\View $this
 */

use yii\helpers\Inflector;
use yii\helpers\Url;

?>
<div class="d-inline-block dropdown">
    <a id="menu-controller" class="tag" href="#" data-bs-toggle="dropdown">
        <?= preg_replace('#/[a-z/]+\z#', '', Inflector::pluralize(Inflector::id2camel(Yii::$app->controller->id))) ?>
        <i class="fas fa-fw fa-sm fa-angle-down"></i>
    </a>
    <div class="dropdown-menu">
        <a class="dropdown-item" data-pjax="0" href="<?= Url::toRoute('/tracks/admin') ?>">Tracks</a>
        <a class="dropdown-item" data-pjax="0" href="<?= Url::toRoute('/playlists/admin') ?>">Playlists</a>
        <a class="dropdown-item" data-pjax="0" href="<?= Url::toRoute('/musicGenres/admin') ?>">MusicGenres</a>
        <a class="dropdown-item" data-pjax="0" href="<?= Url::toRoute('/labels/admin') ?>">Labels</a>
        <a class="dropdown-item" data-pjax="0" href="<?= Url::toRoute('/labelTags/admin') ?>">LabelTags</a>
        <a class="dropdown-item" data-pjax="0" href="<?= Url::toRoute('/stores/admin') ?>">Stores</a>
        <a class="dropdown-item" data-pjax="0" href="<?= Url::toRoute('/storeTags/admin') ?>">StoreTags</a>
        <a class="dropdown-item" data-pjax="0" href="<?= Url::toRoute('/bookmarks/admin') ?>">Bookmarks</a>
        <a class="dropdown-item" data-pjax="0" href="<?= Url::toRoute('/bookmarkTags/admin') ?>">BookmarkTags</a>
    </div>
</div>
