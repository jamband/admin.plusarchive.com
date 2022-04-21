<?php

declare(strict_types=1);

namespace app\controllers\auth;

use app\models\form\SignupForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;

class SignupController extends Controller
{
    public $layout = 'admin/main';

    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex(): string|Response
    {
        $model = new SignupForm();

        if ($model->load($this->request->post())) {
            $user = $model->signup();

            if (null !== $user && Yii::$app->user->login($user)) {
                Yii::$app->session->setFlash('notification', 'Signed up successfully.');

                return $this->goHome();
            }
        }

        return $this->render('//'.$this->id, [
            'model' => $model,
        ]);
    }
}
