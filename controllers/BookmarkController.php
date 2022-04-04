<?php

declare(strict_types=1);

namespace app\controllers;

use app\filters\AccessControl;
use app\models\Bookmark;
use app\models\search\BookmarkSearch;
use Yii;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * @noinspection PhpUnused
 */
class BookmarkController extends Controller
{
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

    public function actionIndex(
        string|null $country = null,
        string|null $tag = null,
        string|null $search = null
    ): string {
        return $this->render('index', [
            'data' => Bookmark::all($country, $tag, $search),
            'country' => $country ?: 'Countries',
            'tag' => $tag ?: 'Tags',
            'search' => $search,
        ]);
    }

    /**
     * @noinspection PhpUnused
     */
    public function actionAdmin(): string
    {
        return $this->render('admin', [
            'search' => $searchModel = new BookmarkSearch,
            'data' => $searchModel->search($this->request->queryParams),
        ]);
    }

    /**
     * @noinspection PhpUnused
     */
    public function actionView(int $id): string
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate(): string|Response
    {
        $model = new Bookmark;
        $model->loadDefaultValues();

        if ($model->load($this->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('notification', 'Bookmark has been added.');

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * @noinspection PhpUnused
     */
    public function actionUpdate(int $id): string|Response
    {
        $model = $this->findModel($id);

        if ($model->load($this->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('notification', 'Bookmark has been updated.');

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete(int $id): Response
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('notification', 'Bookmark has been deleted.');

        return $this->redirect(['admin']);
    }

    protected function findModel(int $id): Bookmark
    {
        $model = Bookmark::findOne($id);

        if (null === $model) {
            throw new NotFoundHttpException('Page not found.');
        }

        return $model;
    }
}
