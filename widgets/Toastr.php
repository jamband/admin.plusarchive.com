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

use yii\base\InvalidArgumentException;
use yii\base\Widget;
use yii\helpers\Json;

/**
 * Toastr class file.
 * @link https://github.com/CodeSeven/toastr
 */
class Toastr extends Widget
{
    /**
     * @var string
     */
    public $type = 'success';

    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $message;

    /**
     * @var string
     */
    public $options;

    private $_allowedTypes = [
        'info',
        'warning',
        'success',
        'error',
    ];

    /**
     * @return void
     */
    public function init(): void
    {
        parent::init();

        $this->options = Json::htmlEncode($this->options);
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function run(): void
    {
        if (!in_array($this->type, $this->_allowedTypes, true)) {
            throw new InvalidArgumentException(self::class.'::type property must be either '.implode('|', $this->_allowedTypes));
        }

        $this->registerClientScript();
    }

    /**
     * Registers the needed JavaScript.
     *
     * @return void
     */
    public function registerClientScript(): void
    {
        $view = $this->getView();
        $view->registerJs("toastr.options = $this->options;");
        $view->registerJs("toastr.$this->type('$this->message', '$this->title');");
    }
}
