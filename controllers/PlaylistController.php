<?php

declare(strict_types=1);

namespace app\controllers;

use app\filters\AccessControl;
use app\models\form\PlaylistUpdateForm;
use app\models\NotFoundModelException;
use app\models\search\PlaylistSearch;
use app\models\form\PlaylistCreateForm;
use app\models\Playlist;
use Jamband\Ripple\Ripple;
use Yii;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * @noinspection PhpUnused
 */
class PlaylistController extends Controller
{
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

    public function actionIndex(): string
    {
        return $this->render('index', [
            'data' => Playlist::all(),
        ]);
    }

    /**
     * @noinspection PhpUnused
     */
    public function actionView(string $id): string
    {
        $model = $this->findModel(Yii::$app->hashids->decode($id));

         /** @var Ripple $ripple */
        $ripple = Yii::createObject(Ripple::class);
        $ripple->options(['embed' => Yii::$app->params['embed-playlist']]);

        return $this->render('view', [
            'model' => $model,
            'embed' => $ripple->embed($model->url, $model->provider_key),
        ]);
    }

    /**
     * @noinspection PhpUnused
     */
    public function actionAdmin(): string
    {
        return $this->render('admin', [
            'search' => $searchModel = new PlaylistSearch,
            'data' => $searchModel->search($this->request->queryParams),
        ]);
    }

    public function actionCreate(): string|Response
    {
        $model = new PlaylistCreateForm;

        if ($model->load($this->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('notification', 'Playlist has been added.');

            return $this->redirect(['admin']);
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
        try {
            $model = new PlaylistUpdateForm($id);
        } catch (NotFoundModelException) {
            throw new NotFoundHttpException('Page not found.');
        }

        if ($model->load($this->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('notification', 'Playlist has been updated.');

            return $this->redirect(['admin']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete(int $id): Response
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('notification', 'Playlist has been deleted.');

        return $this->redirect(['admin']);
    }

    protected function findModel(int $id): Playlist
    {
        $model = Playlist::findOne($id);

        if (null === $model) {
            throw new NotFoundHttpException('Page not found.');
        }

        return $model;
    }
}
