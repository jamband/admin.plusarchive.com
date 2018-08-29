<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace app\controllers\site;

use app\controllers\Controller;

class PrivacyController extends Controller
{
    /**
     * Privacy policy page.
     *
     * @return string
     */
    public function actionIndex(): string
    {
        return $this->render('//'.$this->id);
    }
}
