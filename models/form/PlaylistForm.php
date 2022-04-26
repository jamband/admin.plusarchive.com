<?php

declare(strict_types=1);

namespace app\models\form;

use Jamband\Ripple\Ripple;
use Yii;
use yii\base\Model;
use yii\validators\InlineValidator;

class PlaylistForm extends Model
{
    public string|null $url = null;
    public string|null $title = null;
    public string|null $image = null;

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
        InlineValidator $validator
    ): void {
        if (null === $this->_ripple->image()) {
            $validator->addError($this, $attribute, 'Unable to retrieve the contents from the {attribute}.');
        }
    }

    public function beforeValidate(): bool
    {
        $this->_ripple->request($this->url);

        $this->url = $this->_ripple->url() ?? $this->url;
        $this->title = $this->title ?: $this->_ripple->title();
        $this->image = $this->image ?: $this->_ripple->image();

        return parent::beforeValidate();
    }
}
