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

namespace app\models\form;

use Jamband\Ripple\Ripple;
use Yii;
use yii\base\Model;
use app\models\Track;
use yii\validators\InlineValidator;

class TrackForm extends Model
{
    public $url;
    public $title;
    public $image;
    public $urge;
    public $tagValues;

    /**
     * @var Ripple
     */
    protected $_ripple;

    /**
     * @param array $config
     */
    public function __construct($config = [])
    {
        $this->_ripple = Yii::$container->get(Ripple::class);

        parent::__construct($config);
    }

    /**
     * @return array
     */
    public function attributeLabels(): array
    {
        return [
            'tagValues' => 'Genres',
        ];
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['url'], 'required'],
            [['url', 'title', 'image'], 'trim'],
            [['url', 'image'], 'url'],

            ['url', 'validateValidUrl'],
            ['url', 'validateHasContent'],
            ['title', 'string', 'max' => 200],
            ['urge', 'boolean'],
            ['urge', 'default', 'value' => false],
            ['urge', 'validateLimit'],
            ['tagValues', 'safe'],
        ];
    }

    /**
     * @param string $attribute
     * @return void
     */
    public function validateValidUrl(string $attribute): void
    {
        if (null === $this->_ripple->url()) {
            $this->addError($attribute, 'The URL is invalid.');
        }
    }

    /**
     * @param string $attribute
     * @return void
     */
    public function validateHasContent(string $attribute): void
    {
        if (null === $this->_ripple->id()) {
            $this->addError($attribute, 'Unable to retrieve the contents from the URL.');
        }
    }

    /**
     * @param string $attribute
     * @param mixed $params
     * @param InlineValidator $validator
     *
     * @noinspection PhpUnused
     * @noinspection PhpUnusedParameterInspection $params
     */
    public function validateLimit(string $attribute, $params, InlineValidator $validator): void
    {
        if ('1' === $this->$attribute && 3 <= (int)Track::find()->favorites()->count()) {
            $validator->addError($this, $attribute, 'Only up to 3 {attribute} can be set.');
        }
    }

    /**
     * @return bool
     */
    public function beforeValidate(): bool
    {
        $this->_ripple->request($this->url);

        $this->url = $this->_ripple->url() ?? $this->url;
        $this->title = $this->title ?: $this->_ripple->title();
        $this->image = $this->image ?: $this->_ripple->image();

        return parent::beforeValidate();
    }
}
