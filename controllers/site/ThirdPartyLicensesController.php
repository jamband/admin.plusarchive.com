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
use Yii;

class ThirdPartyLicensesController extends Controller
{
    /**
     * Third-Party Licenses page.
     *
     * @return string
     */
    public function actionIndex(): string
    {
        $path = Yii::getAlias('@app/web/assets/licenses.txt');

        return $this->render('//'.$this->id, [
            'licenses' => file_exists($path)
                ? file_get_contents($path)
                : 'Licenses file was not found.',
        ]);
    }
}
