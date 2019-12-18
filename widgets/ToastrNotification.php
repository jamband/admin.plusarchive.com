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
     * @return void
     */
    public function run(): void
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
