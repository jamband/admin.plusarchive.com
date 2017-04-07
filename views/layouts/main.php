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
 * @var string $content
 * @var yii\web\Controller $context
 */

use app\widgets\ToastrNotification;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;

$context = $this->context;
$this->render('/common/js/analytics-tracking');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= h($this->title) ?></title>
    <link rel="shortcut icon" href="<?= asset('favicon.ico') ?>">
    <link rel="apple-touch-icon" href="<?= asset('icon.png') ?>">
    <link rel="stylesheet" href="<?= asset('app.css')?>">
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
    <?= ToastrNotification::widget() ?>
    <?php NavBar::begin([
        'brandLabel' => '<i class="fa fa-fw fa-angle-up"></i> '.h(app()->name),
        'options' => ['class' => 'navbar-default'],
    ]) ?>
        <?= Nav::widget([
            'options' => ['class' => 'navbar-nav'],
            'items' => [
                ['label' => 'Admin', 'url' => ['/site/admin'], 'visible' => user()->can('admin')],
                ['label' => 'Track', 'url' => ['/track/index'], 'active' => $context->id === 'track'],
                ['label' => 'Playlist', 'url' => ['/playlist/index'], 'active' => $context->id === 'playlist'],
                ['label' => 'Label', 'url' => ['/label/index'], 'active' => $context->id === 'label'],
                ['label' => 'Store', 'url' => ['/store/index'], 'active' => $context->id === 'store'],
                ['label' => 'Bookmark', 'url' => ['/bookmark/index'], 'active' => $context->id === 'bookmark'],
            ],
        ]) ?>
        <?= Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => [
                ['label' => 'Signup', 'url' => ['/site/signup'], 'visible' => user()->can('admin')],
                ['label' => 'Login', 'url' => ['/site/login'], 'visible' => false],
                ['label' => 'Logout', 'url' => ['/site/logout'], 'visible' => user()->can('admin'),
                    'linkOptions' => ['data-method' => 'post']],
            ],
        ]) ?>
    <?php NavBar::end() ?>
    <div class="container">
        <?= $content ?>
    </div>
    <footer class="footer">
        <a href="<?= url(['/']) ?>">Home</a>
        <a href="<?= url(['/site/about']) ?>">About</a>
        <a href="<?= url(['/site/contact']) ?>">Contact</a>
        <a href="<?= url(['/site/privacy']) ?>">Privacy</a>
        <a href="<?= url(['/site/third-party-licenses']) ?>">Third-Party Licenses</a>
    </footer>
    <script src="<?= asset('app.js') ?>"></script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
