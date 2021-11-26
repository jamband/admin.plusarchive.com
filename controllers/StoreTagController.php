<?php

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
     * @noinspection PhpUnused
     */
    public function actionAdmin(): string
    {
        return $this->render('admin', [
            'search' => $searchModel = new StoreTagSearch,
            'data' => $searchModel->search(request()->queryParams),
        ]);
    }

    /**
     * @noinspection PhpUnused
     */
    public function actionUpdate(int $id): string|Response
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

    public function actionDelete(int $id): Response
    {
        $this->findModel($id)->delete();
        session()->setFlash('notification', 'Store tag has been deleted.');

        return $this->redirect(['admin']);
    }

    protected function findModel(int $id): StoreTag
    {
        $model = StoreTag::findOne($id);

        if (null === $model) {
            throw new NotFoundHttpException('Page not found.');
        }

        return $model;
    }
}
