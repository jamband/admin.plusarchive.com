<?php

declare(strict_types=1);

namespace app\controllers\site;

use yii\web\Controller;
use yii\web\ErrorAction;

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
