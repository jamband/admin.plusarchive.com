<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace app\controllers;

use app\models\form\LoginForm;
use app\models\form\SignupForm;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\ErrorAction;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     * @throws NotFoundHttpException
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['admin', 'logout', 'signup'],
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
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => ErrorAction::class,
        ];
    }

    /**
     * Site contact.
     * @return string
     */
    public function actionContact()
    {
        return $this->render('contact');
    }

    /**
     * Privacy policy page.
     * @return string
     */
    public function actionPrivacy()
    {
        return $this->render('privacy');
    }

    /**
     * Site about.
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Maintenance page.
     * @return string
     * @throws NotFoundHttpException If not in maintenance mode
     */
    public function actionOffline()
    {
        if (null === app()->catchAll) {
            throw new NotFoundHttpException('page not found.');
        }
        db()->schema->refresh();
        response()->statusCode = 503;

        return $this->render('offline');
    }

    /**
     * Site admin.
     * @return string
     */
    public function actionAdmin()
    {
        return $this->render('admin');
    }

    /**
     * User login.
     * @return string|Response
     */
    public function actionLogin()
    {
        $model = new LoginForm;

        if ($model->load(request()->post()) && $model->login()) {
            session()->setFlash('success', 'Logged in successfully.');
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * User logout.
     * @return Response
     */
    public function actionLogout()
    {
        user()->logout();
        session()->setFlash('success', 'Logged out successfully.');

        return $this->goHome();
    }

    /**
     * User signup.
     * @return string|Response
     */
    public function actionSignup()
    {
        $model = new SignupForm;

        if ($model->load(request()->post())) {
            $user = $model->signup();

            if (null !== $user && user()->login($user)) {
                session()->setFlash('success', 'Signed up successfully.');
                return $this->goBack();
            }
        }
        return $this->render('signup', [
            'model' => $model,
        ]);
    }
}
