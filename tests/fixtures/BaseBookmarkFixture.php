<?php

declare(strict_types=1);

namespace app\tests\fixtures;

use app\models\Bookmark;
use yii\test\ActiveFixture;

class BaseBookmarkFixture extends ActiveFixture
{
    public $modelClass = Bookmark::class;
}
