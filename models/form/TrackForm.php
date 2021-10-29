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

use app\models\Music;
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

    private const URGE_LIMIT = 6;

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
     * @noinspection PhpUnused
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
     * @noinspection PhpUnused
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
        $favoriteIds = [];
        foreach (Track::find()->favorites()->column() as $id) {
            $favoriteIds[] = (int)$id;
        }

        if ('1' === $this->$attribute && self::URGE_LIMIT <= count($favoriteIds) && !in_array($this->id, $favoriteIds, true)) {
            $validator->addError($this, $attribute, 'Only up to '.self::URGE_LIMIT.' {attribute} can be set.');
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
        $this->image = $this->image ?: $this->convertImage();

        return parent::beforeValidate();
    }

    /**
     * @return string|null
     */
    protected function convertImage(): ?string
    {
        $provider = array_search($this->_ripple->provider(), Music::PROVIDERS, true);
        $image = $this->_ripple->image();

        if (Music::PROVIDER_BANDCAMP === $provider) {
            return preg_replace('/[0-9]+\.jpg\z/', '4.jpg', $image);
        }

        if (Music::PROVIDER_SOUNDCLOUD === $provider) {
            return str_replace('t500x500', 't300x300', $image);
        }

        if (Music::PROVIDER_VIMEO === $provider) {
            return preg_replace('/[x0-9]+\.jpg/', '320.jpg', $image);
        }

        if (Music::PROVIDER_YOUTUBE === $provider) {
            return str_replace('hqdefault.jpg', 'mqdefault.jpg', $image);
        }

        return null;
    }
}
