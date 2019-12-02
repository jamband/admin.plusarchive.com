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
use app\models\NotFoundModelException;
use yii\helpers\ArrayHelper;

class TrackUpdateForm extends TrackForm
{
    public $id;

    /**
     * @var Track|null
     */
    private $_track;

    /**
     * @param int $id;
     * @param array $config
     * @throws NotFoundModelException
     */
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

    /**
     * @return array
     */
    public function rules(): array
    {
        return ArrayHelper::merge(parent::rules(), [
            ['url', 'unique', 'targetClass' => Track::class, 'when' => function () {
                return $this->url !== $this->_track->url;
            }],
        ]);
    }

    /**
     * @return bool
     */
    public function save(): bool
    {
        if ($this->validate()) {
            $this->_track->url = $this->url;
            $this->_track->title = $this->title;
            $this->_track->image = $this->image;
            $this->_track->provider = array_search($this->_ripple->provider(), Track::PROVIDERS, true);
            $this->_track->provider_key = $this->_ripple->id();
            $this->_track->urge = $this->urge;
            $this->_track->tagValues = $this->tagValues;

            return $this->_track->save();
        }

        return false;
    }
}
