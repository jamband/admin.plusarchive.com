<?php

declare(strict_types=1);

namespace app\models\form;

use app\models\Music;
use app\models\Track;
use app\models\NotFoundModelException;
use yii\helpers\ArrayHelper;

class TrackUpdateForm extends TrackForm
{
    public $id;

    private ?Track $_track;

    public function __construct(int $id, array $config = [])
    {
        $this->_track = Track::findOne($id);

        if (null === $this->_track) {
            throw new NotFoundModelException;
        }

        $this->id = $id;
        $this->url = $this->_track->url;
        $this->title = $this->_track->title;
        $this->image = $this->_track->image;
        $this->urge = $this->_track->urge;
        $this->tagValues = $this->_track->tagValues;

        parent::__construct($config);
    }

    public function rules(): array
    {
        return ArrayHelper::merge(parent::rules(), [
            ['url', 'unique', 'targetClass' => Track::class, 'when' => function () {
                return $this->url !== $this->_track->url;
            }],
        ]);
    }

    public function save(): bool
    {
        if ($this->validate()) {
            $this->_track->url = $this->url;
            $this->_track->title = $this->title;
            $this->_track->image = $this->image;
            $this->_track->provider = array_search($this->_ripple->provider(), Music::PROVIDERS, true);
            $this->_track->provider_key = $this->_ripple->id();
            $this->_track->urge = $this->urge;
            $this->_track->tagValues = $this->tagValues;

            return $this->_track->save();
        }

        return false;
    }
}
