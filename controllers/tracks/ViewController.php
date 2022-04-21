<?php

declare(strict_types=1);

namespace app\controllers\tracks;

use app\models\Track;
use Jamband\Ripple\Ripple;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ViewController extends Controller
{
    public function actionIndex(string $id): string
    {
        $model = Track::findOne(Yii::$app->hashids->decode($id));

        if (null === $model) {
            throw new NotFoundHttpException('Page not found.');
        }

        /** @var Ripple $ripple */
        $ripple = Yii::createObject(Ripple::class);
        $ripple->options(['embed' => Yii::$app->params['embed-track']]);

        return $this->render('//'.$this->id, [
            'model' => $model,
            'embed' => $ripple->embed($model->url, $model->provider_key),
        ]);
    }
}
