<?php

declare(strict_types=1);

namespace app\components;

use Yii;
use yii\helpers\Html;
use yii\grid\ActionColumn as ActionColumnBase;

class ActionColumn extends ActionColumnBase
{
    public $buttonOptions = [];

    protected function initDefaultButtons(): void
    {
        $this->initDefaultButton('view', 'eye');
        $this->initDefaultButton('update', 'edit');
        $this->initDefaultButton('delete', 'trash', [
            'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
            'data-method' => 'post',
        ]);
    }

    protected function initDefaultButton(
        $name,
        $iconName,
        $additionalOptions = []
    ): void {
        if (!isset($this->buttons[$name]) && str_contains($this->template, '{'.$name.'}')) {
            $this->buttons[$name] = function (string $url) use ($name, $iconName, $additionalOptions): string {
                $title = match ($name) {
                    'view' => Yii::t('yii', 'View'),
                    'update' => Yii::t('yii', 'Update'),
                    'delete' => Yii::t('yii', 'Delete'),
                    default => ucfirst($name),
                };

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
