<?php

declare(strict_types=1);

namespace app\models\form;

use app\models\Music;
use app\models\Track;
use yii\helpers\ArrayHelper;

class TrackCreateForm extends TrackForm
{
    public function rules(): array
    {
        return ArrayHelper::merge(parent::rules(), [
            ['url', 'unique', 'targetClass' => Track::class],
        ]);
    }

    public function save(): bool
    {
        if ($this->validate()) {
            $track = new Track;
            $track->url = $this->url;
            $track->title = $this->title;
            $track->image = $this->image;
            $track->provider = array_search($this->_ripple->provider(), Music::PROVIDERS, true);
            $track->provider_key = $this->_ripple->id();
            $track->type = Music::TYPE_TRACK;
            $track->urge = $this->urge;
            $track->tagValues = $this->tagValues;

            return $track->save();
        }

        return false;
    }
}
