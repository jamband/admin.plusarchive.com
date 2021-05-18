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
use app\models\form\LoginForm;
use yii\web\Response;

class LoginController extends Controller
{
    /**
     * User login.
     *
     * @return string|Response
     */
    public function actionIndex()
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
