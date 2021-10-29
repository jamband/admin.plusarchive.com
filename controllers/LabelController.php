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
use app\models\Label;
use app\models\search\LabelSearch;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * @noinspection PhpUnused
 */
class LabelController extends Controller
{
    /**
     * @return array
     */
    public function behaviors(): array
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
     * Lists all Label models.
     *
     * @param null|string $sort
     * @param null|string $country
     * @param null|string $tag
     * @param null|string $search
     * @return string
     */
    public function actionIndex(?string $sort = null, ?string $country = null, ?string $tag = null, ?string $search = null): string
    {
        return $this->render('index', [
            'data' => Label::all($sort, $country, $tag, $search),
            'sort' => $sort ?: 'Sort',
            'country' => $country ?: 'Countries',
            'tag' => $tag ?: 'Tags',
            'search' => $search,
        ]);
    }

    /**
     * Manages all Label models.
     *
     * @return string
     */
    public function actionAdmin(): string
    {
        return $this->render('admin', [
            'search' => $searchModel = new LabelSearch,
            'data' => $searchModel->search(request()->queryParams),
        ]);
    }

    /**
     * Displays a single Label model.
     *
     * @param int $id
     * @return string
     */
    public function actionView(int $id): string
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Label model.
     *
     * @return string|Response
     */
    public function actionCreate()
    {
        $model = new Label;

        if ($model->load(request()->post()) && $model->save()) {
            session()->setFlash('notification', 'Label has been added.');

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Label model.
     *
     * @param int $id
     * @return string|Response
     */
    public function actionUpdate(int $id)
    {
        $model = $this->findModel($id);

        if ($model->load(request()->post()) && $model->save()) {
            session()->setFlash('notification', 'Label has been updated.');

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Label model.
     *
     * @param int $id
     * @return Response
     */
    public function actionDelete(int $id): Response
    {
        $this->findModel($id)->delete();
        session()->setFlash('notification', 'Label has been deleted.');

        return $this->redirect(['admin']);
    }

    /**
     * Finds the Label model based on its primary key value.
     *
     * @param int $id
     * @return Label
     * @throws NotFoundHttpException
     */
    protected function findModel(int $id): Label
    {
        $model = Label::findOne($id);

        if (null === $model) {
            throw new NotFoundHttpException('Page not found.');
        }

        return $model;
    }
}
