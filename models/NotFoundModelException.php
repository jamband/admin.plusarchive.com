<?php

declare(strict_types=1);

namespace app\models;

use yii\base\UserException;

class NotFoundModelException extends UserException
{
    public function getName(): string
    {
        return 'Not Found Model';
    }
}
