<?php

declare(strict_types=1);

namespace app\controllers\site;

use app\controllers\Controller;
use yii\web\NotFoundHttpException;

/**
 * @noinspection PhpUnused
 */
class OfflineController extends Controller
{
    public function init(): void
    {
        parent::init();

        if (null === app()->catchAll) {
            throw new NotFoundHttpException('Page not found.');
        }
    }

    public function actionIndex(): string
    {
        db()->schema->refresh();
        response()->statusCode = 503;

        return $this->render('//'.$this->id);
    }
}
