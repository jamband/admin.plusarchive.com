<?php

declare(strict_types=1);

namespace app\models\form;

use app\models\Music;
use app\models\Track;
use Jamband\Ripple\Ripple;
use Yii;
use yii\base\Model;
use yii\validators\InlineValidator;

class TrackForm extends Model
{
    public string|null $url = null;
    public string|null $title = null;
    public string|null $image = null;
    public int $urge = 0;
    public array|string|null $tagValues = null;

    private const URGE_LIMIT = 6;

    protected Ripple $_ripple;

    public function __construct($config = [])
    {
        $this->_ripple = Yii::createObject(Ripple::class);

        parent::__construct($config);
    }

    public function attributeLabels(): array
    {
        return [
            'url' => 'URL',
            'tagValues' => 'Genres',
        ];
    }

    public function rules(): array
    {
        return [
            ['url', 'required'],
            ['url', 'trim'],
            ['url', 'url'],
            ['url', 'validateValidUrl'], /** @see validateValidUrl */
            ['url', 'validateHasContent'], /** @see validateHasContent */

            ['title', 'trim'],
            ['title', 'string', 'max' => 200],

            ['image', 'trim'],
            ['image', 'url'],

            ['urge', 'boolean'],
            ['urge', 'default', 'value' => false],
            ['urge', 'validateLimit'], /** @see validateLimit */

            ['tagValues', 'safe'],
        ];
    }

    public function validateValidUrl(
        string $attribute,
        /** @noinspection PhpUnusedParameterInspection */ mixed $params,
        InlineValidator $validator,
    ): void {
        if (null === $this->_ripple->url()) {
            $validator->addError($this, $attribute, 'The {attribute} is invalid.');
        }
    }

    public function validateHasContent(
        string $attribute,
        /** @noinspection PhpUnusedParameterInspection */ mixed $params,
        InlineValidator $validator,
    ): void {
        if (null === $this->_ripple->image()) {
            $validator->addError($this, $attribute, 'Unable to retrieve the contents from the {attribute}.');
        }
    }

    public function validateLimit(
        string $attribute,
        /** @noinspection PhpUnusedParameterInspection */ mixed $params,
        InlineValidator $validator,
    ): void {
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
        if (null === $this->_ripple->image()) {
            return null;
        }

        $provider = array_search($this->_ripple->provider(), Music::PROVIDERS, true);

        if (!$provider) {
            return null;
        }

        return match ($provider) {
            Music::PROVIDER_BANDCAMP =>
                preg_replace('/[0-9]+\.jpg\z/', '4.jpg', $this->_ripple->image()),

            Music::PROVIDER_SOUNDCLOUD =>
                str_replace('t500x500', 't300x300', $this->_ripple->image()),

            Music::PROVIDER_VIMEO =>
                preg_replace('/[x0-9]+\.jpg/', '320.jpg', $this->_ripple->image()),

            Music::PROVIDER_YOUTUBE =>
                str_replace('hqdefault.jpg', 'mqdefault.jpg', $this->_ripple->image()),

            default => null,
        };
    }
}
