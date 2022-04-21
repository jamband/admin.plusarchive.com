<?php

declare(strict_types=1);

namespace app\controllers\playlists;

use app\models\form\PlaylistCreateForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;

class CreateController extends Controller
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

    public function actionIndex(): string|Response
    {
        $model = new PlaylistCreateForm();

        if ($model->load($this->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('notification', 'Playlist has been added.');

            return $this->redirect(['/playlists/admin/index']);
        }

        return $this->render('//'.$this->id, [
            'model' => $model,
        ]);
    }
}
