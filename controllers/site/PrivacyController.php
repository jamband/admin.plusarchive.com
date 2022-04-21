<?php

declare(strict_types=1);

namespace app\controllers\site;

use yii\web\Controller;

class PrivacyController extends Controller
{
    public function actionIndex(): string
    {
        return $this->render('//'.$this->id);
    }
}
