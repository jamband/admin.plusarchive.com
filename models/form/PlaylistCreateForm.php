<?php

/*
 * This file is part of the admin.plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace app\models\form;

use app\models\Playlist;
use yii\helpers\ArrayHelper;

class PlaylistCreateForm extends PlaylistForm
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return ArrayHelper::merge(parent::rules(), [
            ['url', 'unique', 'targetClass' => Playlist::class],
        ]);
    }

    /**
     * @return bool
     */
    public function save(): bool
    {
        if ($this->validate()) {
            $track = new Playlist;
            $track->url = $this->url;
            $track->title = $this->title;
            $track->image = $this->image;
            $track->provider = array_search($this->_ripple->provider(), Playlist::PROVIDERS, true);
            $track->provider_key = $this->_ripple->id();
            $track->type = Playlist::TYPE_PLAYLIST;

            return $track->save();
        }

        return false;
    }
}
