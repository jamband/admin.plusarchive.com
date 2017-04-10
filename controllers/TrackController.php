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

use app\models\Track;
use jamband\ripple\Ripple;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class TrackController extends Controller
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
                'only' => ['admin', 'create', 'update', 'delete'],
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
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Track models.
     * @param string $provider
     * @param string $genre
     * @param string $search
     * @return string
     */
    public function actionIndex($provider = null, $genre = null, $search = null)
    {
        $query = Track::find()
            ->with(['trackGenres'])
            ->status(Track::STATUS_PUBLISH_TEXT)
            ->provider($provider)
            ->type(Track::TYPE_TRACK_TEXT);

        if (null !== $search) {
            $query->search($search);
        } else {
            $query->orderBy(['created_at' => SORT_DESC]);
        }
        if (null !== $genre) {
            $query->allTagValues($genre);
        }

        return $this->render('index', [
            'data' => new ActiveDataProvider(['query' => $query]),
            'provider' => $provider ?: 'Providers',
            'genre' => $genre ?: 'Genres',
            'search' => $search,
            'embedAction' => url(['now']),
        ]);
    }

    /**
     * Renders the HTML of the now playing track.
     * @param string $id the hashed track id
     * @param string $url
     * @param string $title
     * @param string $provider
     * @param string $key provider key
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionNow($id = null, $url = null, $title = null, $provider = null, $key = null)
    {
        if (!request()->isAjax) {
            throw new NotFoundHttpException('Page not found.');
        }
        $ripple = new Ripple;
        $ripple->setEmbedParams(app()->params['embed-track-modal']);

        return $this->renderAjax('now', [
            'embed' => $ripple->embed($url, $provider, $key),
            'id' => $id,
            'title' => $title,
            'provider' => $provider,
        ]);
    }

    /**
     * Displays a single Track model.
     * @param string $id the hashed track id
     * @return string
     */
    public function actionView($id)
    {
        $model = $this->findModel(
            hashids()->decode($id), Track::STATUS_PUBLISH_TEXT
        );
        $ripple = new Ripple;
        $ripple->setEmbedParams(app()->params['embed-track']);

        return $this->render('view', [
            'model' => $model,
            'embed' => $ripple->embed($model->url, $model->providerText, $model->provider_key),
        ]);
    }

    /**
     * Manages all Track models.
     * @param int $status
     * @param string $provider
     * @param string $sort
     * @param string $genre
     * @param string $search
     * @return string
     */
    public function actionAdmin($status = null, $provider = null, $sort = null, $genre = null, $search = null)
    {
        $query = Track::find()
            ->with(['trackGenres'])
            ->type(Track::TYPE_TRACK_TEXT);

        if (null !== $search) {
            $query->search($search);
        } else {
            $query->status($status)
                ->provider($provider)
                ->sort($sort);
        }
        if (null !== $genre) {
            $query->allTagValues($genre);
        }

        return $this->render('admin', [
            'data' => new ActiveDataProvider(['query' => $query]),
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
     * @return string|Response
     */
    public function actionCreate()
    {
        $model = new Track;
        $model->loadDefaultValues();

        if ($model->load(request()->post()) && $model->setContents()->save()) {
            session()->setFlash('success', 'New track has been added.');
            return $this->redirect(['admin']);
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Track model.
     * @param int $id
     * @return string|Response
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(request()->post()) && $model->setContents()->save()) {
            session()->setFlash('success', 'Track has been updated.');
            return $this->redirect(['admin']);
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Track model.
     * @param int $id
     * @return string
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        session()->setFlash('success', 'Track has been deleted.');

        return $this->redirect(['admin']);
    }

    /**
     * Finds the Track model based on its primary key value.
     * @param int $id
     * @param int $status
     * @return Track|array
     * @throws NotFoundHttpException
     */
    protected function findModel($id, $status = null)
    {
        $model = Track::find()
            ->andWhere(['id' => $id])
            ->status($status)
            ->type(Track::TYPE_TRACK_TEXT)
            ->one();

        if (null === $model) {
            throw new NotFoundHttpException('Page not found.');
        }
        return $model;
    }
}
