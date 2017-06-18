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

use app\models\Bookmark;
use app\models\search\BookmarkSearch;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class BookmarkController extends Controller
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
                'only' => ['admin', 'create', 'view', 'update', 'delete'],
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
     * Lists all Bookmark models.
     * @param string $sort
     * @param string $country
     * @param string $search
     * @param string $tag
     * @return string
     */
    public function actionIndex($sort = null, $country = null, $search = null, $tag = null)
    {
        $query = Bookmark::find()
            ->with(['bookmarkTags'])
            ->status(Bookmark::STATUS_PUBLISH);

        if (null !== $search) {
            $query->search($search);
        } else {
            $query->country($country)
                ->sort($sort);
        }
        if (null !== $tag) {
            $query->allTagValues($tag);
        }

        return $this->render('index', [
            'data' => new ActiveDataProvider([
                'query' => $query,
                'pagination' => ['pageSize' => 8],
            ]),
            'sort' => $sort ?: 'Sort',
            'country' => $country ?: 'Countries',
            'tag' => $tag ?: 'Tags',
            'search' => $search,
        ]);
    }

    /**
     * Manages all Bookmark models.
     * @return string
     */
    public function actionAdmin()
    {
        return $this->render('admin', [
            'search' => $searchModel = new BookmarkSearch,
            'data' => $searchModel->search(request()->queryParams),
        ]);
    }

    /**
     * Displays a single Bookmark model.
     * @param int $id
     * @return string
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Bookmark model.
     * @return string|Response
     */
    public function actionCreate()
    {
        $model = new Bookmark;
        $model->loadDefaultValues();

        if ($model->load(request()->post()) && $model->save()) {
            session()->setFlash('success', 'Bookmark has been added.');
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Bookmark model.
     * @param int $id
     * @return string|Response
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(request()->post()) && $model->save()) {
            session()->setFlash('success', 'Bookmark has been updated.');
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Bookmark model.
     * @param int $id
     * @return Response
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        session()->setFlash('success', 'Bookmark has been deleted.');

        return $this->redirect(['admin']);
    }

    /**
     * Finds the Bookmark model based on its primary key value.
     * @param int $id
     * @return Bookmark
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        $model = Bookmark::findOne($id);
        if (null === $model) {
            throw new NotFoundHttpException('Page not found.');
        }
        return $model;
    }
}
