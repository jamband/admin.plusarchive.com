<?php

 declare(strict_types=1);

return yii\helpers\ArrayHelper::merge(require __DIR__.'/common.php', [
    'id' => 'console',
    'controllerNamespace' => 'app\commands',
]);
