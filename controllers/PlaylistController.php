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

use app\models\search\PlaylistSearch;
use app\models\Playlist;
use jamband\ripple\Ripple;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class PlaylistController extends Controller
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
     * Lists all Playlist models.
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index', [
            'data' => new ActiveDataProvider([
                'query' => Playlist::find()
                    ->status(Playlist::STATUS_PUBLISH)
                    ->orderBy(['updated_at' => SORT_DESC]),
                'pagination' => false,
            ]),
        ]);
    }

    /**
     * Displays some PlaylistItem models by playlist primary key.
     * @param string $id the hashed playlist id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel(
            hashids()->decode($id), Playlist::STATUS_PUBLISH
        );
        $key = '';
        $provider = '';

        if (!empty($model->items)) {
            $key = $model->items[0]->track->provider_key;
            $provider = $model->items[0]->track->providerText;
        }
        $ripple = new Ripple;
        $ripple->setEmbedParams(app()->params['ripple-embed-view']);

        return $this->render('view', [
            'model' => $model,
            'provider' => $provider,
            'embed' => $ripple->embed($provider, $key),
        ]);
    }

    /**
     * Manages all Playlist models.
     * @return mixed
     */
    public function actionAdmin()
    {
        return $this->render('admin', [
            'search' => $searchModel = new PlaylistSearch,
            'data' => $searchModel->search(request()->queryParams),
        ]);
    }

    /**
     * Creates a new Playlist model.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Playlist;

        if ($model->load(request()->post()) && $model->save()) {
            session()->setFlash('success', 'Playlist has been added.');
            return $this->redirect(['/playlist-item/create']);
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Playlist model.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(request()->post()) && $model->save()) {
            session()->setFlash('success', 'Playlist has been updated.');
            return $this->redirect(['admin']);
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Playlist model.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        session()->setFlash('success', 'Playlist has been deleted.');

        return $this->redirect(['admin']);
    }

    /**
     * Finds the Playlist model based on its primary key value.
     * @param integer $id
     * @param null|integer $status
     * @return Bookmark
     * @throws NotFoundHttpException
     */
    protected function findModel($id, $status = null)
    {
        $model = Playlist::find()
            ->andWhere(['id' => $id])
            ->status($status)
            ->one();

        if (null === $model) {
            throw new NotFoundHttpException('Page not found.');
        }
        return $model;
    }
}
