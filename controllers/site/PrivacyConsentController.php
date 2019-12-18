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
use yii\filters\AjaxFilter;
use yii\helpers\ArrayHelper;

class PrivacyConsentController extends Controller
{
    /**
     * @return array
     */
    public function behaviors(): array
    {
        return ArrayHelper::merge(parent::behaviors(), [
            ['class' => AjaxFilter::class],
        ]);
    }

    /**
     * Privacy consent.
     *
     * @return void
     */
    public function actionIndex(): void
    {
        if (!session()->has('privacy-consent')) {
            session()->set('privacy-consent', 'ok');
        }
    }
}
