<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace app\models\form;

use app\models\Track;
use yii\helpers\ArrayHelper;

class TrackCreateForm extends TrackForm
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return ArrayHelper::merge(parent::rules(), [
            ['url', 'unique', 'targetClass' => Track::class],
        ]);
    }

    /**
     * @return bool
     */
    public function save(): bool
    {
        if ($this->validate()) {
            $track = new Track;
            $track->url = $this->url;
            $track->title = $this->title;
            $track->image = $this->image;
            $track->provider = array_search($this->_ripple->provider(), Track::PROVIDERS, true);
            $track->provider_key = $this->_ripple->id();
            $track->type = Track::TYPE_TRACK;
            $track->urge = $this->urge;
            $track->tagValues = $this->tagValues;

            return $track->save();
        }

        return false;
    }
}
