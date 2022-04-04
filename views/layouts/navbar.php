<?php

/**
 * @var yii\web\View $this
 */

use yii\helpers\Html;
use yii\helpers\Url;

$cid = Yii::$app->controller->id;
?>
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container">
        <a class="fw-bold navbar-brand" href="<?= Yii::$app->homeUrl ?>"><?= Html::encode(Yii::$app->name) ?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-collapse" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <div class="d-md-none navbar-nav">
                <a class="nav-link<?= 'track' === $cid ? ' active' : '' ?>" href="<?= Url::to(['/track/index']) ?>">Tracks</a>
                <a class="nav-link<?= 'playlist' === $cid ? ' active' : '' ?>" href="<?= Url::to(['/playlist/index']) ?>">Playlists</a>
                <a class="nav-link<?= 'label' === $cid ? ' active' : '' ?>" href="<?= Url::to(['/label/index']) ?>">Labels</a>
                <a class="nav-link<?= 'store' === $cid ? ' active' : '' ?>" href="<?= Url::to(['/store/index']) ?>">Stores</a>
                <a class="nav-link<?= 'bookmark' === $cid ? ' active' : '' ?>" href="<?= Url::to(['/bookmark/index']) ?>">Bookmarks</a>
                <a class="nav-link<?= 'site/about' === $cid ? ' active' : '' ?>" href="<?= Url::to(['/site/about/index']) ?>">Abouts</a>
                <a class="nav-link<?= 'site/privacy' === $cid ? ' active' : '' ?>" href="<?= Url::to(['/site/privacy/index']) ?>">Privacy</a>
                <a class="nav-link<?= 'site/contact' === $cid ? ' active' : '' ?>" href="<?= Url::to(['/site/contact/index']) ?>">Contact</a>
                <a class="nav-link<?= 'site/third-party-licenses' === $cid ? ' active' : '' ?>" href="<?= Url::to(['/site/third-party-licenses/index']) ?>">Third Party Licenses</a>
            </div>
            <div id="navbar" class="d-none d-md-flex navbar-nav">
                <a class="nav-link<?= 'track' === $cid ? ' active' : '' ?>" href="<?= Url::to(['/track/index']) ?>">Tracks</a>
                <a class="nav-link<?= 'playlist' === $cid ? ' active' : '' ?>" href="<?= Url::to(['/playlist/index']) ?>">Playlists</a>
                <a class="nav-link<?= 'label' === $cid ? ' active' : '' ?>" href="<?= Url::to(['/label/index']) ?>">Labels</a>
                <a class="nav-link<?= 'store' === $cid ? ' active' : '' ?>" href="<?= Url::to(['/store/index']) ?>">Stores</a>
                <a class="nav-link<?= 'bookmark' === $cid ? ' active' : '' ?>" href="<?= Url::to(['/bookmark/index']) ?>">Bookmarks</a>
                <div class="dropdown">
                    <a class="nav-link" href="#" id="dropdownMoreLinks" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-h"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMoreLinks">
                        <a class="dropdown-item" href="<?= Url::to(['/site/about/index']) ?>">About</a>
                        <a class="dropdown-item" href="<?= Url::to(['/site/privacy/index']) ?>">Privacy</a>
                        <a class="dropdown-item" href="<?= Url::to(['/site/contact/index']) ?>">Contact</a>
                        <a class="dropdown-item" href="<?= Url::to(['/site/third-party-licenses/index']) ?>">Third Party Licenses</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
