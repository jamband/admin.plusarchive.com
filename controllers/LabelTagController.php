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

use app\models\LabelTag;
use app\models\search\LabelTagSearch;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class LabelTagController extends Controller
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
                'only' => ['admin', 'list', 'update', 'delete'],
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
     * Manages all LabelTag models.
     * @return string
     */
    public function actionAdmin()
    {
        return $this->render('admin', [
            'search' => $searchModel = new LabelTagSearch,
            'data' => $searchModel->search(request()->queryParams),
        ]);
    }

    /**
     * Returns all tag name.
     * @return Response
     * @throws NotFoundHttpException
     */
    public function actionList()
    {
        if (!request()->isAjax) {
            throw new NotFoundHttpException('Page not found.');
        }
        return $this->asJson(LabelTag::getNames()->all());
    }

    /**
     * Updates an existing LabelTag model.
     * @param int $id
     * @return string|Response
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(request()->post()) && $model->save()) {
            session()->setFlash('success', 'Label tag has been updated.');
            return $this->redirect(['admin']);
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing LabelTag model.
     * @param int $id
     * @return Response
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        session()->setFlash('success', 'Label tag has been deleted.');

        return $this->redirect(['admin']);
    }

    /**
     * Finds the Bookmark model based on its primary key value.
     * @param int $id
     * @return LabelTag
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        $model = LabelTag::findOne($id);
        if (null === $model) {
            throw new NotFoundHttpException('Page not found.');
        }
        return $model;
    }
}
