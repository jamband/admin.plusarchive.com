<?php

declare(strict_types=1);

namespace app\models\form;

use Jamband\Ripple\Ripple;
use Yii;
use yii\base\Model;

class PlaylistForm extends Model
{
    public $url;
    public $title;
    public $image;

    protected Ripple $_ripple;

    public function __construct($config = [])
    {
        $this->_ripple = Yii::$container->get(Ripple::class);

        parent::__construct($config);
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

    public function beforeValidate(): bool
    {
        $this->_ripple->request($this->url);

        $this->url = $this->_ripple->url() ?? $this->url;
        $this->title = $this->title ?: $this->_ripple->title();
        $this->image = $this->image ?: $this->_ripple->image();

        return parent::beforeValidate();
    }
}
