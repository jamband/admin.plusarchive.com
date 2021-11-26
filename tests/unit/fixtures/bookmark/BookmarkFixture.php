<?php

declare(strict_types=1);

namespace app\tests\unit\fixtures\bookmark;

use app\models\Bookmark;
use yii\test\ActiveFixture;

class BookmarkFixture extends ActiveFixture
{
    public $modelClass = Bookmark::class;
}
