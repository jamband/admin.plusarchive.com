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
        <a class="dropdown-item" data-pjax="0" href="<?= Url::to(['/track/admin']) ?>">Tracks</a>
        <a class="dropdown-item" data-pjax="0" href="<?= Url::to(['/playlist/admin']) ?>">Playlists</a>
        <a class="dropdown-item" data-pjax="0" href="<?= Url::to(['/music-genre/admin']) ?>">MusicGenres</a>
        <a class="dropdown-item" data-pjax="0" href="<?= Url::to(['/label/admin']) ?>">Labels</a>
        <a class="dropdown-item" data-pjax="0" href="<?= Url::to(['/label-tag/admin']) ?>">LabelTags</a>
        <a class="dropdown-item" data-pjax="0" href="<?= Url::to(['/store/admin']) ?>">Stores</a>
        <a class="dropdown-item" data-pjax="0" href="<?= Url::to(['/store-tag/admin']) ?>">StoreTags</a>
        <a class="dropdown-item" data-pjax="0" href="<?= Url::to(['/bookmark/admin']) ?>">Bookmarks</a>
        <a class="dropdown-item" data-pjax="0" href="<?= Url::to(['/bookmark-tag/admin']) ?>">BookmarkTags</a>
    </div>
</div>
