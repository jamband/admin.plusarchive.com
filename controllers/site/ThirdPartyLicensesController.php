<?php

declare(strict_types=1);

namespace app\controllers\site;

use Yii;
use yii\helpers\Html;
use yii\web\Controller;

class ThirdPartyLicensesController extends Controller
{
    public function actionIndex(): string
    {
        $path = Yii::getAlias('@app/web/'.Html::asset('app.js').'.LICENSE.txt');

        return $this->render('//'.$this->id, [
            'licenses' => file_exists($path)
                ? file_get_contents($path)
                : 'Licenses file was not found.',
        ]);
    }
}
