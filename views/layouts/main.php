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
    <main class="container pt-4 pb-8 pb-sm-7">
        <?= $content ?>
    </main>
    <footer class="fixed-bottom p-3 text-center bg-dark">
        <?php if (Yii::$app->session->has('privacy-consent')): ?>
            <?= $this->render('/common/analytics-tracking') ?>
        <?php else: ?>
            <?= $this->render('/common/privacy-consent') ?>
        <?php endif ?>
    </footer>
    <script src="<?= Html::asset('app.js') ?>"></script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
