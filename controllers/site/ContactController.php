<?php

declare(strict_types=1);

namespace app\controllers\site;

use yii\web\Controller;

class ContactController extends Controller
{
    public function actionIndex(): string
    {
        return $this->render('//'.$this->id);
    }
}
