<?php

declare(strict_types=1);

namespace app\controllers\tracks;

use Jamband\Ripple\Ripple;
use Yii;
use yii\filters\AjaxFilter;
use yii\web\Controller;

class NowController extends Controller
{
    public function behaviors(): array
    {
        return [
            [
                'class' => AjaxFilter::class,
            ],
        ];
    }

    public function actionIndex(
        string $id,
        string $url,
        string $title,
        string $provider,
        string $key,
    ): string {
        /** @var Ripple $ripple */
        $ripple = Yii::createObject(Ripple::class);
        $ripple->options(['embed' => Yii::$app->params['embed-track-modal']]);

        return $this->renderAjax('//'.$this->id, [
            'embed' => $ripple->embed($url, $key),
            'id' => $id,
            'title' => $title,
            'provider' => $provider,
        ]);
    }
}
