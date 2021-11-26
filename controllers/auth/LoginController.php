<?php

declare(strict_types=1);

namespace app\controllers\auth;

use app\controllers\Controller;
use app\models\form\LoginForm;
use yii\web\Response;

/**
 * @noinspection PhpUnused
 */
class LoginController extends Controller
{
    public function actionIndex(): string|Response
    {
        if (!user()->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm;

        if ($model->load(request()->post()) && $model->login()) {
            session()->setFlash('notification', 'Logged in successfully.');

            return $this->goBack();
        }

        return $this->render('//'.$this->id, [
            'model' => $model,
        ]);
    }
}
