<?php

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

    public function actionIndex(): string|Response
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
