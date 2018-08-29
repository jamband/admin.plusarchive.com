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

namespace app\controllers\auth;

use app\controllers\Controller;
use app\models\form\SignupForm;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\web\Response;

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
                'denyCallback' => function () {
                    throw new NotFoundHttpException('Page not found.');
                }
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
                session()->setFlash('success', 'Signed up successfully.');

                return $this->goBack();
            }
        }

        return $this->render('//'.$this->id, [
            'model' => $model,
        ]);
    }
}
