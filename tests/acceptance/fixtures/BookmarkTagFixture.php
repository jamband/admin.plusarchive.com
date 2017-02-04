<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace app\tests\acceptance\fixtures;

use app\models\BookmarkTag;
use yii\test\ActiveFixture;

class BookmarkTagFixture extends ActiveFixture
{
    public $modelClass = BookmarkTag::class;

    public $dataFile = '@app/tests/acceptance/fixtures/data/bookmark_tag.php';
}
