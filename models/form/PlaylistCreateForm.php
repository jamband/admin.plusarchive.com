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
            $track = new Playlist;
            $track->url = $this->url;
            $track->title = $this->title;
            $track->image = $this->image;
            $track->provider = array_search($this->_ripple->provider(), Music::PROVIDERS, true);
            $track->provider_key = $this->_ripple->id();
            $track->type = Music::TYPE_PLAYLIST;

            return $track->save();
        }

        return false;
    }
}
