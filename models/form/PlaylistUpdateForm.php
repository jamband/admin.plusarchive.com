<?php

declare(strict_types=1);

namespace app\models\form;

use app\models\Music;
use app\models\NotFoundModelException;
use app\models\Playlist;
use yii\helpers\ArrayHelper;

class PlaylistUpdateForm extends PlaylistForm
{
    public $id;

    private ?Playlist $_playlist;

    public function __construct(int $id, array $config = [])
    {
        $this->_playlist = Playlist::findOne($id);

        if (null === $this->_playlist) {
            throw new NotFoundModelException;
        }

        $this->id = $id;
        $this->url = $this->_playlist->url;
        $this->title = $this->_playlist->title;
        $this->image = $this->_playlist->image;

        parent::__construct($config);
    }

    public function rules(): array
    {
        return ArrayHelper::merge(parent::rules(), [
            ['url', 'unique', 'targetClass' => Playlist::class, 'when' => function () {
                return $this->url !== $this->_playlist->url;
            }],
        ]);
    }

    public function save(): bool
    {
        if ($this->validate()) {
            $this->_playlist->url = $this->url;
            $this->_playlist->title = $this->title;
            $this->_playlist->image = $this->image;
            $this->_playlist->provider = array_search($this->_ripple->provider(), Music::PROVIDERS, true);
            $this->_playlist->provider_key = $this->_ripple->id();

            return $this->_playlist->save();
        }

        return false;
    }
}
