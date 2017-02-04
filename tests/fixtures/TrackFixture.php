<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace app\tests\fixtures;

use app\models\Track;
use yii\test\ActiveFixture;

class TrackFixture extends ActiveFixture
{
    public $modelClass = Track::class;

    public $dataFile = '@app/tests/fixtures/data/track.php';
}
