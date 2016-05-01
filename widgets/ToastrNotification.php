<?php

namespace app\widgets;

use Yii;
use yii\helpers\Json;

/**
 * ToastrNotification class file.
 * @link https://github.com/CodeSeven/toastr
 */
class ToastrNotification extends Toastr
{
    /**
     * @inheritdoc
     */
    public function run()
    {
        $session = Yii::$app->getSession();
        $options = Json::decode($this->options);

        foreach ($session->getAllFlashes() as $type => $messages) {
            foreach ((array)$messages as $message) {
                Toastr::widget(compact('type', 'message', 'options'));
            }
            $session->removeFlash($type);
        }
    }
}
