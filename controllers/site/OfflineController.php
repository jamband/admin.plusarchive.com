<?php

/*
 * This file is part of the admin.plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace app\controllers\site;

use app\controllers\Controller;
use yii\web\NotFoundHttpException;

class OfflineController extends Controller
{
    /**
     * @return void
     * @throws NotFoundHttpException If not in maintenance mode
     */
    public function init(): void
    {
        parent::init();

        if (null === app()->catchAll) {
            throw new NotFoundHttpException('Page not found.');
        }
    }

    /**
     * Maintenance page.
     *
     * @return string
     */
    public function actionIndex(): string
    {
        db()->schema->refresh();
        response()->statusCode = 503;

        return $this->render('//'.$this->id);
    }
}
