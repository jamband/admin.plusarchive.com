<?php

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
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <?php $this->registerCsrfMetaTags() ?>
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
    <div class="container pt-4 pb-6">
        <?= $content ?>
    </div>
    <footer class="fixed-bottom p-3 text-center text-light bg-dark">
        <i class="fas fa-fw fa-info-circle"></i>
        Currently logged in as an administrator.
    </footer>
    <script src="<?= asset('app.js') ?>"></script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
