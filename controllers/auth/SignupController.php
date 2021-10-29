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

namespace app\controllers\auth;

use app\controllers\Controller;
use app\filters\AccessControl;
use app\models\form\SignupForm;
use yii\helpers\ArrayHelper;
use yii\web\Response;

/**
 * @noinspection PhpUnused
 */
class SignupController extends Controller
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
     * User signup.
     *
     * @return string|Response
     */
    public function actionIndex()
    {
        $model = new SignupForm;

        if ($model->load(request()->post())) {
            $user = $model->signup();

            if (null !== $user && user()->login($user)) {
                session()->setFlash('notification', 'Signed up successfully.');

                return $this->goBack();
            }
        }

        return $this->render('//'.$this->id, [
            'model' => $model,
        ]);
    }
}
