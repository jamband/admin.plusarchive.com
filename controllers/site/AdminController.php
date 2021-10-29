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
use app\filters\AccessControl;
use app\models\Track;
use yii\helpers\ArrayHelper;

/**
 * @noinspection PhpUnused
 */
class AdminController extends Controller
{
    /**
     * @return array
     */
    public function behaviors(): array
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
        ]);
    }

    /**
     * Site admin.
     *
     * @return string
     */
    public function actionIndex(): string
    {
        $tracks = Track::find()
            ->favorites()
            ->latest()
            ->all();

        return $this->render('//'.$this->id, [
            'tracks' => $tracks,
        ]);
    }
}
