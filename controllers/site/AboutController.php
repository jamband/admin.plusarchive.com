<?php

declare(strict_types=1);

namespace app\controllers\site;

use app\controllers\Controller;

/**
 * @noinspection PhpUnused
 */
class AboutController extends Controller
{
    public function actionIndex(): string
    {
        return $this->render('//'.$this->id);
    }
}
