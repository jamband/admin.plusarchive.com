<?php

declare(strict_types=1);

namespace app\controllers\site;

use Yii;
use yii\filters\AjaxFilter;
use yii\web\Controller;

class PrivacyOptOutController extends Controller
{
    public function behaviors(): array
    {
        return [
            ['class' => AjaxFilter::class],
        ];
    }

    public function actionIndex(): void
    {
        if (Yii::$app->session->has('privacy-consent')) {
            Yii::$app->session->remove('privacy-consent');
        }
    }
}
