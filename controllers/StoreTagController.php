<?php

/*
 * This file is part of the admin.plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace app\controllers;

use app\filters\AccessControl;
use app\models\search\StoreTagSearch;
use app\models\StoreTag;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * @noinspection PhpUnused
 */
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
     * Updates an existing StoreTag model.
     *
     * @param int $id
     * @return string|Response
     */
    public function actionUpdate(int $id)
    {
        $model = $this->findModel($id);

        if ($model->load(request()->post()) && $model->save()) {
            session()->setFlash('notification', 'Store tag has been updated.');

            return $this->redirect(['admin']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing StoreTag model.
     *
     * @param int $id
     * @return Response
     */
    public function actionDelete(int $id): Response
    {
        $this->findModel($id)->delete();
        session()->setFlash('notification', 'Store tag has been deleted.');

        return $this->redirect(['admin']);
    }

    /**
     * Finds the StoreTag model based on its primary key value.
     *
     * @param int $id
     * @return StoreTag
     * @throws NotFoundHttpException
     */
    protected function findModel(int $id): StoreTag
    {
        $model = StoreTag::findOne($id);

        if (null === $model) {
            throw new NotFoundHttpException('Page not found.');
        }

        return $model;
    }
}
