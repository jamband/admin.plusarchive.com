<?php

declare(strict_types=1);

use yii\helpers\ArrayHelper;

return ArrayHelper::merge(require __DIR__.'/common.php', [
    'id' => 'console',
    'controllerNamespace' => 'app\commands',
]);
