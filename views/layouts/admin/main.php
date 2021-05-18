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
    <footer class="fixed-bottom p-3 bg-dark text-center font-weight-bold">
        <i class="fas fa-info-circle"></i>
        Currently logged in as an administrator.
    </footer>
    <script src="<?= asset('app.js') ?>"></script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
