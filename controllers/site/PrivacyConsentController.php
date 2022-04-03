<?php

declare(strict_types=1);

namespace app\controllers\site;

use app\controllers\Controller;
use Yii;
use yii\filters\AjaxFilter;
use yii\helpers\ArrayHelper;

class PrivacyConsentController extends Controller
{
    public function behaviors(): array
    {
        return ArrayHelper::merge(parent::behaviors(), [
            ['class' => AjaxFilter::class],
        ]);
    }

    public function actionIndex(): void
    {
        if (!Yii::$app->session->has('privacy-consent')) {
            Yii::$app->session->set('privacy-consent', 'ok');
        }
    }
}
