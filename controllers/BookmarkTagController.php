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
use app\models\BookmarkTag;
use app\models\search\BookmarkTagSearch;
use yii\filters\AjaxFilter;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class BookmarkTagController extends Controller
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
     * Manages all BookmarkTag models.
     *
     * @return string
     */
    public function actionAdmin(): string
    {
        return $this->render('admin', [
            'search' => $searchModel = new BookmarkTagSearch,
            'data' => $searchModel->search(request()->queryParams),
        ]);
    }

    /**
     * Returns all tag names.
     *
     * @return Response
     */
    public function actionList(): Response
    {
        return $this->asJson(BookmarkTag::getNames()->all());
    }

    /**
     * Updates an existing BookmarkTag model.
     *
     * @param string $id
     * @return string|Response
     */
    public function actionUpdate(string $id)
    {
        $model = $this->findModel($id);

        if ($model->load(request()->post()) && $model->save()) {
            session()->setFlash('success', 'Bookmark tag has been updated.');

            return $this->redirect(['admin']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing BookmarkTag model.
     *
     * @param string $id
     * @return Response
     */
    public function actionDelete(string $id): Response
    {
        $this->findModel($id)->delete();
        session()->setFlash('success', 'Bookmark tag has been deleted.');

        return $this->redirect(['admin']);
    }

    /**
     * Finds the BookmarkTag model based on its primary key value.
     *
     * @param string $id
     * @return BookmarkTag
     * @throws NotFoundHttpException
     */
    protected function findModel(string $id): BookmarkTag
    {
        $model = BookmarkTag::findOne($id);

        if (null === $model) {
            throw new NotFoundHttpException('Page not found.');
        }

        return $model;
    }
}
