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

use app\models\Bookmark;
use yii\test\ActiveFixture;

class BookmarkFixture extends ActiveFixture
{
    public $modelClass = Bookmark::class;

    public $dataFile = '@fixture/bookmark.php';

    public $depends = [
        UserFixture::class,
    ];
}
