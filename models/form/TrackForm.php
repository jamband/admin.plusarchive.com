<?php

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

    protected Ripple $_ripple;

    /**
     * @param array $config
     */
    public function __construct($config = [])
    {
        $this->_ripple = Yii::$container->get(Ripple::class);

        parent::__construct($config);
    }

    public function attributeLabels(): array
    {
        return [
            'tagValues' => 'Genres',
        ];
    }

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
     */
    public function validateValidUrl(string $attribute): void
    {
        if (null === $this->_ripple->url()) {
            $this->addError($attribute, 'The URL is invalid.');
        }
    }

    /**
     * @noinspection PhpUnused
     */
    public function validateHasContent(string $attribute): void
    {
        if (null === $this->_ripple->id()) {
            $this->addError($attribute, 'Unable to retrieve the contents from the URL.');
        }
    }

    /**
     * @noinspection PhpUnused
     * @noinspection PhpUnusedParameterInspection $params
     */
    public function validateLimit(string $attribute, mixed $params, InlineValidator $validator): void
    {
        $favoriteIds = [];
        foreach (Track::find()->favorites()->column() as $id) {
            $favoriteIds[] = (int)$id;
        }

        if ('1' === $this->$attribute && self::URGE_LIMIT <= count($favoriteIds) && !in_array($this->id, $favoriteIds, true)) {
            $validator->addError($this, $attribute, 'Only up to '.self::URGE_LIMIT.' {attribute} can be set.');
        }
    }

    public function beforeValidate(): bool
    {
        $this->_ripple->request($this->url);

        $this->url = $this->_ripple->url() ?? $this->url;
        $this->title = $this->title ?: $this->_ripple->title();
        $this->image = $this->image ?: $this->convertImage();

        return parent::beforeValidate();
    }

    protected function convertImage(): string|null
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
