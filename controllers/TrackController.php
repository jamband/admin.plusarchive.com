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
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class TrackController extends Controller
{
    /**
     * @inheritdoc
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
     * @return mixed
     */
    public function actionIndex($provider = null, $genre = null, $search = null)
    {
        $query = Track::find()
            ->with(['trackGenres'])
            ->provider($provider)
            ->status(Track::STATUS_PUBLISH_TEXT);

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
            'embedUrl' => url(['now']),
        ]);
    }

    /**
     * Renders the HTML of the now playing track.
     * @param string $id the hashed track id
     * @return mixed
     */
    public function actionNow($id = null)
    {
        if (!request()->isAjax) {
            throw new NotFoundHttpException('Page not found.');
        }
        $model = $this->findModel(hashids()->decode($id));
        $ripple = new Ripple;
        $ripple->setEmbedParams(app()->params['ripple-embed-index']);

        return $this->renderAjax('now', [
            'model' => $model,
            'embed' => $ripple->embed($model->providerText, $model->provider_key),
            'id' => $id,
        ]);
    }

    /**
     * Displays a single Track model.
     * @param string $id the hashed track id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel(
            hashids()->decode($id), Track::STATUS_PUBLISH_TEXT
        );
        $ripple = new Ripple;
        $ripple->setEmbedParams(app()->params['ripple-embed-view']);

        return $this->render('view', [
            'model' => $model,
            'embed' => $ripple->embed($model->providerText, $model->provider_key),
        ]);
    }

    /**
     * Manages all Track models.
     * @param integer $status
     * @param string $provider
     * @param string $sort
     * @param string $genre
     * @param string $search
     * @return mixed
     */
    public function actionAdmin($status = null, $provider = null, $sort = null, $genre = null, $search = null)
    {
        $query = Track::find()
            ->with(['trackGenres']);

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
            'embedUrl' => url(['now']),
        ]);
    }

    /**
     * Creates a new Track model.
     * @return mixed
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
     * @param integer $id
     * @return mixed
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
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        session()->setFlash('success', 'Track has been deleted.');

        return $this->redirect(['admin']);
    }

    /**
     * Finds the Track model based on its primary key value.
     * @param integer $id
     * @param null|integer $status
     * @return Track
     * @throws NotFoundHttpException
     */
    protected function findModel($id, $status = null)
    {
        $model = Track::find()
            ->andWhere(['id' => $id])
            ->status($status)
            ->one();

        if (null === $model) {
            throw new NotFoundHttpException('Page not found.');
        }
        return $model;
    }
}
