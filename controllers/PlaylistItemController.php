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

use app\models\form\PlaylistItemCreateForm;
use app\models\form\PlaylistItemSortForm;
use app\models\PlaylistItem;
use app\models\search\PlaylistItemSearch;
use app\models\Track;
use jamband\ripple\Ripple;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class PlaylistItemController extends Controller
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
                'only' => ['admin', 'create', 'sort', 'delete'],
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
     * Manages all PlaylistItem models.
     * @return mixed
     */
    public function actionAdmin()
    {
        return $this->render('admin', [
            'search' => $searchModel = new PlaylistItemSearch,
            'data' => $searchModel->search(request()->queryParams),
        ]);
    }

    /**
     * Creates a new PlaylistItem model.
     * @param string $status
     * @param string $provider
     * @param string $genre
     * @param string $search
     * @return mixed
     */
    public function actionCreate($status = null, $provider = null, $genre = null, $search = null)
    {
        $query = Track::find()
            ->with(['trackGenres'])
            ->provider($provider)
            ->status($status);

        if (null !== $search) {
            $query->search($search);
        } else {
            $query->orderBy(['created_at' => SORT_DESC]);
        }
        if (null !== $genre) {
            $query->allTagValues($genre);
        }
        $model = new PlaylistItemCreateForm;

        if ($model->load(request()->post()) && $model->save()) {
            session()->setFlash('success', 'Playlist item has been added.');
            return $this->redirect(['admin']);
        }
        return $this->render('create', [
            'status' => $status ?: 'Status',
            'provider' => $provider ?: 'Providers',
            'genre' => $genre ?: 'Genres',
            'search' => $search,
            'data' => new ActiveDataProvider(['query' => $query]),
            'embedUrl' => url(['track/now']),
            'model' => $model,
        ]);
    }

    /**
     * Returns the playlist items by playlist primary key.
     * @param integer $playlistId
     * @param string $playlistTitle
     * @return mixed
     */
    public function actionList($playlistId = null, $playlistTitle = null)
    {
        if (!request()->isAjax) {
            throw new NotFoundHttpException('Page not found.');
        }
        $models = PlaylistItem::find()
            ->with(['track'])
            ->playlist($playlistId)
            ->orderBy(['track_number' => SORT_ASC])
            ->all();

        if (empty($models)) {
            return null;
        }
        return $this->renderAjax('list', [
            'models' => $models,
            'provider' => $models[0]->track->providerText,
            'playlistTitle' => $playlistTitle,
        ]);
    }

    /**
     * Sorts the playlist items.
     * @param integer $playlist_id
     * @return mixed
     */
    public function actionSort($playlist_id)
    {
        $items = PlaylistItem::find()
            ->with(['track', 'playlist'])
            ->playlist($playlist_id)
            ->orderBy(['track_number' => SORT_ASC])
            ->all();

        if (empty($items[0])) {
            throw new NotFoundHttpException('Page not found.');
        }
        $model = new PlaylistItemSortForm;

        if ($model->load(request()->post()) && $model->save()) {
            session()->setFlash('success', 'Playlist items has been sorted.');
            return $this->redirect(['admin']);
        }
        $ripple = new Ripple;
        $ripple->setEmbedParams(app()->params['ripple-embed-view']);

        $provider = $items[0]->track->providerText;

        return $this->render('sort', [
            'playlistTitle' => $items[0]->playlist->title,
            'provider' => $provider,
            'playlist_id' => $items[0]->playlist_id,
            'items' => $items,
            'model' => $model,
            'embed' => $ripple->embed($provider, $items[0]->track->provider_key),
        ]);
    }

    /**
     * Deletes an existing PlaylistItem model.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        session()->setFlash('success', 'Playlist item has been deleted.');

        return $this->redirect(['admin']);
    }

    /**
     * Finds the PlaylistItem model based on its primary key value.
     * @param integer $id
     * @return PlaylistItem
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        $model = PlaylistItem::findOne($id);
        if (null === $model) {
            throw new NotFoundHttpException('Page not found.');
        }
        return $model;
    }
}
