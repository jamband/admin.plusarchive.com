<?php

declare(strict_types=1);

namespace app\controllers\site;

use app\controllers\Controller;
use yii\web\ErrorAction;

/**
 * @noinspection PhpUnused
 */
class ErrorController extends Controller
{
    public function actions(): array
    {
        return [
            'index' => [
                'class' => ErrorAction::class,
                'view' => '//'.$this->id,
            ],
        ];
    }
}
