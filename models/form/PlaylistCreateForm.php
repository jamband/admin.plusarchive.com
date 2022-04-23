<?php

declare(strict_types=1);

namespace app\models\form;

use app\models\Music;
use app\models\Playlist;
use yii\helpers\ArrayHelper;

class PlaylistCreateForm extends PlaylistForm
{
    public function rules(): array
    {
        return ArrayHelper::merge(parent::rules(), [
            ['url', 'unique', 'targetClass' => Playlist::class],
        ]);
    }

    public function save(): bool
    {
        if ($this->validate()) {
            $playlist = new Playlist();
            $playlist->url = $this->url;
            $playlist->title = $this->title;
            $playlist->image = $this->image;
            $playlist->provider = array_search($this->_ripple->provider(), Music::PROVIDERS, true);
            $playlist->provider_key = $this->_ripple->id();
            $playlist->type = Music::TYPE_PLAYLIST;

            return $playlist->save();
        }

        return false;
    }
}
