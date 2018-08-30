<?php

declare(strict_types=1);

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace app\controllers;

use app\filters\AccessControl;
use app\models\search\StoreTagSearch;
use app\models\StoreTag;
use yii\filters\AjaxFilter;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class StoreTagController extends Controller
{
    /**
     * @return array
     */
    public function behaviors(): array
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
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            [
                'class' => AjaxFilter::class,
                'only' => ['list'],
            ],
        ];
    }

    /**
     * Manages all StoreTag models.
     *
     * @return string
     */
    public function actionAdmin(): string
    {
        return $this->render('admin', [
            'search' => $searchModel = new StoreTagSearch,
            'data' => $searchModel->search(request()->queryParams),
        ]);
    }

    /**
     * Returns all tag name.
     *
     * @return Response
     */
    public function actionList(): Response
    {
        return $this->asJson(StoreTag::getNames()->all());
    }

    /**
     * Updates an existing StoreTag model.
     *
     * @param string $id
     * @return string|Response
     */
    public function actionUpdate(string $id)
    {
        $model = $this->findModel($id);

        if ($model->load(request()->post()) && $model->save()) {
            session()->setFlash('success', 'Store tag has been updated.');

            return $this->redirect(['admin']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing StoreTag model.
     *
     * @param string $id
     * @return Response
     */
    public function actionDelete(string $id): Response
    {
        $this->findModel($id)->delete();
        session()->setFlash('success', 'Store tag has been deleted.');

        return $this->redirect(['admin']);
    }

    /**
     * Finds the StoreTag model based on its primary key value.
     *
     * @param string $id
     * @return StoreTag
     * @throws NotFoundHttpException
     */
    protected function findModel(string $id): StoreTag
    {
        $model = StoreTag::findOne($id);

        if (null === $model) {
            throw new NotFoundHttpException('Page not found.');
        }

        return $model;
    }
}
