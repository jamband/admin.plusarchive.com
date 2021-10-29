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

namespace app\controllers;

use app\filters\AccessControl;
use app\models\form\TrackCreateForm;
use app\models\form\TrackUpdateForm;
use app\models\NotFoundModelException;
use app\models\Track;
use Jamband\Ripple\Ripple;
use Yii;
use yii\filters\AjaxFilter;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class TrackController extends Controller
{
    /**
     * @return array
     */
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => [
                    'admin',
                    'create',
                    'update',
                    'delete',
                    'stop-all-urge',
                ],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['post'],
                    'stop-all-urge' => ['post'],
                ],
            ],
            [
                'class' => AjaxFilter::class,
                'only' => ['now'],
            ],
        ];
    }

    /**
     * Lists all Track models.
     *
     * @param null|string $provider
     * @param null|string $genre
     * @param null|string $search
     * @return string
     */
    public function actionIndex(?string $provider = null, ?string $genre = null, ?string $search = null): string
    {
        return $this->render('index', [
            'data' => Track::all($provider, $genre, $search),
            'provider' => $provider ?: 'Providers',
            'genre' => $genre ?: 'Genres',
            'search' => $search,
            'embedAction' => url(['now']),
        ]);
    }

    /**
     * Renders the HTML of the now playing track.
     *
     * @param string $id the hashed track id
     * @param string $url
     * @param string $title
     * @param string $provider
     * @param string $key provider key
     * @return string
     */
    public function actionNow(string $id, string $url, string $title, string $provider, string $key): string
    {
        /** @var Ripple $ripple */
        $ripple = Yii::createObject(Ripple::class);
        $ripple->options(['embed' => app()->params['embed-track-modal']]);

        return $this->renderAjax('now', [
            'embed' => $ripple->embed($url, $key),
            'id' => $id,
            'title' => $title,
            'provider' => $provider,
        ]);
    }

    /**
     * Displays a single Track model.
     *
     * @param string $id the hashed track id
     * @return string
     */
    public function actionView(string $id): string
    {
        $model = $this->findModel(hashids()->decode($id));

        /** @var Ripple $ripple */
        $ripple = Yii::createObject(Ripple::class);
        $ripple->options(['embed' => app()->params['embed-track']]);

        return $this->render('view', [
            'model' => $model,
            'embed' => $ripple->embed($model->url, $model->provider_key),
        ]);
    }

    /**
     * Manages all Track models.
     *
     * @param null|string $sort
     * @param null|string $provider
     * @param null|string $genre
     * @param null|string $search
     * @return string
     */
    public function actionAdmin(?string $sort = null, ?string $provider = null, ?string $genre = null, ?string $search = null): string
    {
        return $this->render('admin', [
            'data' => Track::allAsAdmin($sort, $provider, $genre, $search),
            'sort' => $sort ?: 'Sort',
            'provider' => $provider ?: 'Providers',
            'genre' => $genre ?: 'Genres',
            'search' => $search,
            'embedAction' => url(['now']),
        ]);
    }

    /**
     * Creates a new Track model.
     *
     * @return string|Response
     */
    public function actionCreate()
    {
        $model = new TrackCreateForm;

        if ($model->load(request()->post()) && $model->save()) {
            session()->setFlash('notification', 'New track has been added.');

            return $this->redirect(['admin']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Track model.
     *
     * @param int $id
     * @return string|Response
     */
    public function actionUpdate(int $id)
    {
        try {
            $model = new TrackUpdateForm($id);
        } catch (NotFoundModelException $e) {
            throw new NotFoundHttpException('Page not found.');
        }

        if ($model->load(request()->post()) && $model->save()) {
            session()->setFlash('notification', 'Track has been updated.');

            return $this->redirect(['admin']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Track model.
     *
     * @param int $id
     * @return Response
     */
    public function actionDelete(int $id): Response
    {
        $this->findModel($id)->delete();
        session()->setFlash('notification', 'Track has been deleted.');

        return $this->redirect(['admin']);
    }

    /**
     * @return Response
     */
    public function actionStopAllUrge(): Response
    {
        Track::stopAllUrge();
        session()->setFlash('notification', 'All Urge of track has been stopped.');

        return $this->redirect(['/admin']);
    }

    /**
     * Finds the Track model based on its primary key value.
     *
     * @param int $id
     * @return Track
     * @throws NotFoundHttpException
     */
    protected function findModel(int $id): Track
    {
        $model = Track::findOne($id);

        if (null === $model) {
            throw new NotFoundHttpException('Page not found.');
        }

        return $model;
    }
}
