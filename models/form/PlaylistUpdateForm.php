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

use app\models\NotFoundModelException;
use app\models\Playlist;
use yii\helpers\ArrayHelper;

class PlaylistUpdateForm extends PlaylistForm
{
    public $id;

    /**
     * @var Playlist|null
     */
    private $_playlist;

    /**
     * @param int $id
     * @param array $config
     */
    public function __construct(int $id, $config = [])
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

    /**
     * @return array
     */
    public function rules(): array
    {
        return ArrayHelper::merge(parent::rules(), [
            ['url', 'unique', 'targetClass' => Playlist::class, 'when' => function () {
                return $this->url !== $this->_playlist->url;
            }],
        ]);
    }

    /**
     * @return bool
     */
    public function save(): bool
    {
        if ($this->validate()) {
            $this->_playlist->url = $this->url;
            $this->_playlist->title = $this->title;
            $this->_playlist->image = $this->image;
            $this->_playlist->provider = array_search($this->_ripple->provider(), Playlist::PROVIDERS, true);
            $this->_playlist->provider_key = $this->_ripple->id();

            return $this->_playlist->save();
        }

        return false;
    }
}
