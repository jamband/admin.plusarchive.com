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
use app\models\search\PlaylistSearch;
use app\models\Track;
use jamband\ripple\Ripple;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class PlaylistController extends Controller
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
        ];
    }

    /**
     * Lists all playlists of Track models.
     *
     * @return string
     */
    public function actionIndex(): string
    {
        return $this->render('index', [
            'data' => Track::allPlaylists(),
        ]);
    }

    /**
     * Displays a specific playlist of Track model.
     *
     * @param string $id the hashed playlist id
     * @return string
     */
    public function actionView(string $id): string
    {
        $model = $this->findModel(hashids()->decode($id));

        $ripple = new Ripple;
        $ripple->setEmbedParams(app()->params['embed-playlist']);

        return $this->render('view', [
            'model' => $model,
            'embed' => $ripple->embed($model->url, $model->provider_key),
        ]);
    }

    /**
     * Manages all playlists of Track model.
     *
     * @return string
     */
    public function actionAdmin(): string
    {
        return $this->render('admin', [
            'search' => $searchModel = new PlaylistSearch,
            'data' => $searchModel->search(request()->queryParams),
        ]);
    }

    /**
     * Creates a new playlist of Track model.
     *
     * @return string|Response
     */
    public function actionCreate()
    {
        $model = new Track;
        $model->type = Track::TYPE_PLAYLIST;

        if ($model->load(request()->post()) && $model->save()) {
            session()->setFlash('success', 'Playlist has been added.');

            return $this->redirect(['admin']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing playlist of Track model.
     *
     * @param int $id
     * @return string|Response
     */
    public function actionUpdate(int $id)
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
     * Deletes an existing playlist of Track model.
     *
     * @param int $id
     * @return Response
     */
    public function actionDelete(int $id): Response
    {
        $this->findModel($id)->delete();
        session()->setFlash('success', 'Playlist has been deleted.');

        return $this->redirect(['admin']);
    }

    /**
     * Finds the playlist of Track model based on its primary key value.
     *
     * @param int $id
     * @return array|Track
     * @throws NotFoundHttpException
     */
    protected function findModel(int $id)
    {
        $model = Track::onePlaylist($id);

        if (null === $model) {
            throw new NotFoundHttpException('Page not found.');
        }

        return $model;
    }
}
