<?php

declare(strict_types=1);

namespace app\controllers\site;

use app\controllers\Controller;
use yii\filters\AjaxFilter;
use yii\helpers\ArrayHelper;

/**
 * @noinspection PhpUnused
 */
class PrivacyOptOutController extends Controller
{
    public function behaviors(): array
    {
        return ArrayHelper::merge(parent::behaviors(), [
            ['class' => AjaxFilter::class],
        ]);
    }

    public function actionIndex(): void
    {
        if (session()->has('privacy-consent')) {
            session()->remove('privacy-consent');
        }
    }
}
