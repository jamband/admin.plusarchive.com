<?php

declare(strict_types=1);

namespace app\controllers\playlists;

use app\models\form\PlaylistUpdateForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class UpdateController extends Controller
{
    public $layout = 'admin/main';

    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex(int $id): string|Response
    {
        $model = new PlaylistUpdateForm($id);

        if (null === $model->id) {
            throw new NotFoundHttpException('Page not found.');
        }

        if ($model->load($this->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('notification', 'Playlist has been updated.');

            return $this->redirect(['/playlists/admin/index']);
        }

        return $this->render('//'.$this->id, [
            'model' => $model,
        ]);
    }
}
