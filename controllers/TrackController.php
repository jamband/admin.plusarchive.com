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

namespace app\controllers;

use app\filters\AccessControl;
use app\models\Track;
use jamband\ripple\Ripple;
use yii\data\ActiveDataProvider;
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
                'only' => ['admin', 'create', 'update', 'delete'],
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
        $query = Track::find()
            ->with(['trackGenres'])
            ->status(Track::STATUSES[Track::STATUS_PUBLISH])
            ->provider($provider)
            ->type(Track::TYPES[Track::TYPE_TRACK]);

        if (null !== $search) {
            $query->search($search);
        } else {
            $query->orderBy(['created_at' => SORT_DESC]);
        }

        if (null !== $genre && '' !== $genre) {
            $query->allTagValues($genre);
        }

        return $this->render('index', [
            'data' => new ActiveDataProvider([
                'query' => $query,
                'pagination' => ['pageSize' => 24],
            ]),
            'provider' => $provider ?: 'Providers',
            'genre' => $genre ?: 'Genres',
            'search' => $search,
            'embedAction' => url(['now']),
        ]);
    }

    /**
     * Renders the HTML of the now playing track.
     *
     * @param null|string $id the hashed track id
     * @param null|string $url
     * @param null|string $title
     * @param null|string $provider
     * @param null|string $key provider key
     * @return string
     */
    public function actionNow(?string $id = null, ?string $url = null, ?string $title = null, ?string $provider = null, ?string $key = null): string
    {
        $ripple = new Ripple;
        $ripple->setEmbedParams(app()->params['embed-track-modal']);

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
        $model = $this->findModel(
            (string)hashids()->decode($id), Track::STATUSES[Track::STATUS_PUBLISH]
        );

        $ripple = new Ripple;
        $ripple->setEmbedParams(app()->params['embed-track']);

        return $this->render('view', [
            'model' => $model,
            'embed' => $ripple->embed($model->url, $model->provider_key),
        ]);
    }

    /**
     * Manages all Track models.
     *
     * @param null|string $status
     * @param null|string $provider
     * @param null|string $sort
     * @param null|string $genre
     * @param null|string $search
     * @return string
     */
    public function actionAdmin(?string $status = null, ?string $provider = null, ?string $sort = null, ?string $genre = null, ?string $search = null): string
    {
        $query = Track::find()
            ->with(['trackGenres'])
            ->type(Track::TYPES[Track::TYPE_TRACK]);

        if (null !== $search) {
            $query->search($search);
        } else {
            $query->status($status)
                ->provider($provider)
                ->sort($sort);
        }

        if (null !== $genre && '' !== $genre) {
            $query->allTagValues($genre);
        }

        return $this->render('admin', [
            'data' => new ActiveDataProvider([
                'query' => $query,
                'pagination' => ['pageSize' => 24],
            ]),
            'provider' => $provider ?: 'Providers',
            'sort' => $sort ?: 'Sort',
            'genre' => $genre ?: 'Genres',
            'status' => $status ?: 'Status',
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
        $model = new Track;
        $model->loadDefaultValues();

        if ($model->load(request()->post()) && $model->save()) {
            session()->setFlash('success', 'New track has been added.');

            return $this->redirect(['admin']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Track model.
     *
     * @param string $id
     * @return string|Response
     */
    public function actionUpdate(string $id)
    {
        $model = $this->findModel($id);

        if ($model->load(request()->post()) && $model->save()) {
            session()->setFlash('success', 'Track has been updated.');

            return $this->redirect(['admin']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Track model.
     *
     * @param string $id
     * @return Response
     */
    public function actionDelete(string $id): Response
    {
        $this->findModel($id)->delete();
        session()->setFlash('success', 'Track has been deleted.');

        return $this->redirect(['admin']);
    }

    /**
     * Finds the Track model based on its primary key value.
     *
     * @param string $id
     * @param null|string $status
     * @return Track|array
     * @throws NotFoundHttpException
     */
    protected function findModel(string $id, ?string $status = null)
    {
        $model = Track::find()
            ->andWhere(['id' => $id])
            ->status($status)
            ->type(Track::TYPES[Track::TYPE_TRACK])
            ->one();

        if (null === $model) {
            throw new NotFoundHttpException('Page not found.');
        }

        return $model;
    }
}
