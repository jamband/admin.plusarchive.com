<?php

declare(strict_types=1);

namespace app\controllers\auth;

use app\models\form\LoginForm;
use Yii;
use yii\web\Controller;
use yii\web\Response;

class LoginController extends Controller
{
    public function actionIndex(): string|Response
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();

        if ($model->load($this->request->post()) && $model->login()) {
            Yii::$app->session->setFlash('notification', 'Logged in successfully.');

            return $this->goBack();
        }

        return $this->render('//'.$this->id, [
            'model' => $model,
        ]);
    }
}
