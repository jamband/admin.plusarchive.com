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
/* @var $content string */

use app\widgets\ToastrNotification;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;

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
    <link href="<?= asset_revision('favicon.ico') ?>" rel="icon">
    <link href="//fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link href="<?= asset_revision('css/common.css') ?>" rel="stylesheet">
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
    <?= ToastrNotification::widget() ?>
    <?php NavBar::begin([
        'brandLabel' => h(app()->name),
        'options' => ['class' => 'navbar-default'],
    ]) ?>
        <?= Nav::widget([
            'options' => ['class' => 'navbar-nav'],
            'items' => [
                ['label' => 'Admin', 'url' => ['/site/admin'], 'visible' => user()->can('admin')],
                ['label' => 'Track', 'url' => ['/track/index'], 'active' => $this->context->id === 'track'],
                ['label' => 'Playlist', 'url' => ['/playlist/index'], 'active' => $this->context->id === 'playlist'],
                ['label' => 'Label', 'url' => ['/label/index'], 'active' => $this->context->id === 'label'],
                ['label' => 'Store', 'url' => ['/store/index'], 'active' => $this->context->id === 'store'],
                ['label' => 'Bookmark', 'url' => ['/bookmark/index'], 'active' => $this->context->id === 'bookmark'],
            ],
        ]) ?>
        <?= Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => [
                ['label' => 'Contact', 'url' => ['/site/contact']],
                ['label' => 'Privacy', 'url' => ['/site/privacy']],
                ['label' => 'About', 'url' => ['/site/about']],
                ['label' => 'Signup', 'url' => ['/site/signup'], 'visible' => user()->can('admin')],
                ['label' => 'Login', 'url' => ['/site/login'], 'visible' => false],
                ['label' => 'Logout', 'url' => ['/site/logout'], 'visible' => user()->can('admin'),
                    'linkOptions' => ['data-method' => 'post']],
            ],
        ]) ?>
    <?php NavBar::end() ?>
    <div class="container"><?= $content ?></div>
    <script src="<?= asset_revision('js/common.js') ?>"></script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
