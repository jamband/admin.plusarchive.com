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
 */

use app\widgets\ToastrNotification;
use yii\helpers\Html;

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= h($this->title) ?></title>
    <link rel="icon" type="image/png" href="<?= asset('favicon.png') ?>">
    <link rel="apple-touch-icon" sizes="152x152" href="<?= asset('apple-touch-icon.png') ?>">
    <link rel="stylesheet" href="<?= asset('app.css')?>">
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
    <?= ToastrNotification::widget() ?>
    <?= $this->render('navbar') ?>
    <div class="container">
        <?= $content ?>
    </div>
    <footer class="footer">
        <a href="<?= url(['/site/privacy']) ?>">Privacy</a>
        <a href="<?= url(['/site/third-party-licenses']) ?>">Third-Party Licenses</a>
    </footer>
    <script src="<?= asset('vendor.js') ?>"></script>
    <script src="<?= asset('app.js') ?>"></script>
    <script src="<?= asset('admin.js') ?>"></script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
