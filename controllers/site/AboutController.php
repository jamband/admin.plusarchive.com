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

class AboutController extends Controller
{
    /**
     * Site about.
     *
     * @return string
     */
    public function actionIndex(): string
    {
        return $this->render('//'.$this->id);
    }
}
