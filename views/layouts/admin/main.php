<?php

/**
 * @var yii\web\View $this
 * @var string $content
 */

use yii\helpers\Html;

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="icon" type="image/png" href="<?= Html::asset('favicon.png') ?>">
    <link rel="apple-touch-icon" sizes="152x152" href="<?= Html::asset('apple-touch-icon.png') ?>">
    <link rel="stylesheet" href="<?= Html::asset('app.css')?>">
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
    <?php if (Yii::$app->session->hasFlash('notification')): ?>
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
    <script src="<?= Html::asset('app.js') ?>"></script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
