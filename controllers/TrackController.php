<?php

declare(strict_types=1);

namespace app\controllers;

use app\filters\AccessControl;
use app\models\form\TrackCreateForm;
use app\models\form\TrackUpdateForm;
use app\models\NotFoundModelException;
use app\models\Track;
use Jamband\Ripple\Ripple;
use Yii;
use yii\filters\AjaxFilter;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * @noinspection PhpUnused
 */
class TrackController extends Controller
{
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => [
                    'admin',
                    'create',
                    'update',
                    'delete',
                    'stop-all-urge',
                ],
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
                    'stop-all-urge' => ['post'],
                ],
            ],
            [
                'class' => AjaxFilter::class,
                'only' => ['now'],
            ],
        ];
    }

    public function actionIndex(
        string|null $provider = null,
        string|null $genre = null,
        string|null $search = null,
    ): string {
        return $this->render('index', [
            'data' => Track::all($provider, $genre, $search),
            'provider' => $provider ?: 'Providers',
            'genre' => $genre ?: 'Genres',
            'search' => $search,
            'embedAction' => url(['now']),
        ]);
    }

    /**
     * @noinspection PhpUnused
     */
    public function actionNow(
        string $id,
        string $url,
        string $title,
        string $provider,
        string $key,
    ): string {
        /** @var Ripple $ripple */
        $ripple = Yii::createObject(Ripple::class);
        $ripple->options(['embed' => app()->params['embed-track-modal']]);

        return $this->renderAjax('now', [
            'embed' => $ripple->embed($url, $key),
            'id' => $id,
            'title' => $title,
            'provider' => $provider,
        ]);
    }

    /**
     * @noinspection PhpUnused
     */
    public function actionView(string $id): string
    {
        $model = $this->findModel(hashids()->decode($id));

        /** @var Ripple $ripple */
        $ripple = Yii::createObject(Ripple::class);
        $ripple->options(['embed' => app()->params['embed-track']]);

        return $this->render('view', [
            'model' => $model,
            'embed' => $ripple->embed($model->url, $model->provider_key),
        ]);
    }

    /**
     * @noinspection PhpUnused
     */
    public function actionAdmin(
        string|null $sort = null,
        string|null $provider = null,
        string|null $genre = null,
        string|null $search = null,
    ): string {
        return $this->render('admin', [
            'data' => Track::allAsAdmin($sort, $provider, $genre, $search),
            'sort' => $sort ?: 'Sort',
            'provider' => $provider ?: 'Providers',
            'genre' => $genre ?: 'Genres',
            'search' => $search,
            'embedAction' => url(['now']),
        ]);
    }

    public function actionCreate(): string|Response
    {
        $model = new TrackCreateForm;

        if ($model->load(request()->post()) && $model->save()) {
            session()->setFlash('notification', 'New track has been added.');

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
            $model = new TrackUpdateForm($id);
        } catch (NotFoundModelException $e) {
            throw new NotFoundHttpException('Page not found.');
        }

        if ($model->load(request()->post()) && $model->save()) {
            session()->setFlash('notification', 'Track has been updated.');

            return $this->redirect(['admin']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete(int $id): Response
    {
        $this->findModel($id)->delete();
        session()->setFlash('notification', 'Track has been deleted.');

        return $this->redirect(['admin']);
    }

    /**
     * @noinspection PhpUnused
     */
    public function actionStopAllUrge(): Response
    {
        Track::stopAllUrge();
        session()->setFlash('notification', 'All Urge of track has been stopped.');

        return $this->redirect(['/admin']);
    }

    protected function findModel(int $id): Track
    {
        $model = Track::findOne($id);

        if (null === $model) {
            throw new NotFoundHttpException('Page not found.');
        }

        return $model;
    }
}
