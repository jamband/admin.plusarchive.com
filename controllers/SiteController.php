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
use Yii;
use yii\filters\AccessControl;
use yii\filters\AjaxFilter;
use yii\filters\VerbFilter;
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
            [
                'class' => AjaxFilter::class,
                'only' => ['privacy-consent', 'privacy-opt-out'],
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
     * Privacy consent
     * @return void
     */
    public function actionPrivacyConsent()
    {
        if (!session()->has('privacy-consent')) {
            session()->set('privacy-consent', 'ok');
        }
    }

    /**
     * Privacy policy opt-out
     * @return void
     */
    public function actionPrivacyOptOut()
    {
        if (session()->has('privacy-consent')) {
            session()->remove('privacy-consent');
        }
    }

    /**
     * Third-Party Licenses page.
     * @return string
     */
    public function actionThirdPartyLicenses()
    {
        $path = Yii::getAlias('@app/web/assets/licenses.txt');

        return $this->render('third-party-licenses', [
            'licenses' => file_exists($path)
                ? file_get_contents($path)
                : 'Licenses file was not found.',
        ]);
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
        if (!user()->isGuest) {
            return $this->goHome();
        }

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
