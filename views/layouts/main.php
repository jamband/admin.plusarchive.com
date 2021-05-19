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
 * @var string $content
 */
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= $this->registerCsrfMetaTags() ?>
    <title><?= h($this->title) ?></title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;600&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="<?= asset('favicon.png') ?>">
    <link rel="apple-touch-icon" sizes="152x152" href="<?= asset('apple-touch-icon.png') ?>">
    <link rel="stylesheet" href="<?= asset('app.css')?>">
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
    <?php if (session()->hasFlash('notification')): ?>
        <?= $this->render('/common/notification') ?>
    <?php endif ?>
    <?= $this->render('navbar') ?>
    <div class="container layout-main">
        <?= $content ?>
    </div>
    <footer class="fixed-bottom p-3 text-center bg-dark font-weight-bold">
        <?php if (session()->has('privacy-consent')): ?>
            <?= $this->render('/common/analytics-tracking') ?>
        <?php else: ?>
            <?= $this->render('/common/privacy-consent') ?>
        <?php endif ?>
    </footer>
    <script src="<?= asset('app.js') ?>"></script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
