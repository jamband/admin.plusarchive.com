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

namespace app\components;

use Yii;
use yii\helpers\Html;
use yii\grid\ActionColumn as ActionColumnBase;

class ActionColumn extends ActionColumnBase
{
    /**
     * @var array
     */
    public $buttonOptions = [];

    /**
     * @return void
     */
    protected function initDefaultButtons(): void
    {
        $this->initDefaultButton('view', 'eye');
        $this->initDefaultButton('update', 'edit');
        $this->initDefaultButton('delete', 'trash', [
            'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
            'data-method' => 'post',
        ]);
    }

    /**
     * @param string $name
     * @param string $iconName
     * @param array $additionalOptions
     * @return void
     */
    protected function initDefaultButton($name, $iconName, $additionalOptions = []): void
    {
        if (!isset($this->buttons[$name]) && strpos($this->template, '{'.$name.'}') !== false) {
            $this->buttons[$name] = function (string $url) use ($name, $iconName, $additionalOptions): string {
                switch ($name) {
                    case 'view':
                        $title = Yii::t('yii', 'View');
                        break;
                    case 'update':
                        $title = Yii::t('yii', 'Update');
                        break;
                    case 'delete':
                        $title = Yii::t('yii', 'Delete');
                        break;
                    default:
                        $title = ucfirst($name);
                }

                $options = array_merge([
                    'title' => $title,
                    'aria-label' => $title,
                    'data-pjax' => '0',
                ], $additionalOptions, $this->buttonOptions);

                $icon = Html::tag('i', '', ['class' => "fas fa-fw fa-$iconName"]);

                return Html::a($icon, $url, $options);
            };
        }
    }
}
