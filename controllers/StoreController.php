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

use app\models\Store;
use app\models\search\StoreSearch;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class StoreController extends Controller
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
     * Lists all Store models.
     * @param string $sort
     * @param string $tag
     * @param string $search
     * @return mixed
     */
    public function actionIndex($sort = null, $tag = null, $search = null)
    {
        $query = Store::find()
            ->with(['storeTags']);

        if (null !== $search) {
            $query->search($search);
        } else {
            $query->sort($sort);
        }
        if (null !== $tag) {
            $query->allTagValues($tag);
        }

        return $this->render('index', [
            'data' => new ActiveDataProvider([
                'query' => $query,
                'pagination' => ['pageSize' => 10],
            ]),
            'sort' => $sort ?: 'Sort',
            'tag' => $tag ?: 'Tags',
            'search' => $search,
        ]);
    }

    /**
     * Manages all Store models.
     * @return mixed
     */
    public function actionAdmin()
    {
        return $this->render('admin', [
            'search' => $searchModel = new StoreSearch,
            'data' => $searchModel->search(request()->queryParams),
        ]);
    }

    /**
     * Displays a single Store model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Store model.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Store;

        if ($model->load(request()->post()) && $model->save()) {
            session()->setFlash('success', 'Store has been added.');
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Store model.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(request()->post()) && $model->save()) {
            session()->setFlash('success', 'Store has been updated.');
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Store model.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        session()->setFlash('success', 'Store has been deleted.');

        return $this->redirect(['admin']);
    }

    /**
     * Finds the Store model based on its primary key value.
     * @param integer $id
     * @return Store
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        $model = Store::findOne($id);
        if (null === $model) {
            throw new NotFoundHttpException('Page not found.');
        }
        return $model;
    }
}
