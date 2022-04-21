<?php

declare(strict_types=1);

namespace app\controllers\site;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class OfflineController extends Controller
{
    public function init(): void
    {
        parent::init();

        if (null === Yii::$app->catchAll) {
            throw new NotFoundHttpException('Page not found.');
        }
    }

    public function actionIndex(): string
    {
        Yii::$app->db->schema->refresh();
        $this->response->statusCode = 503;

        return $this->render('//'.$this->id);
    }
}
