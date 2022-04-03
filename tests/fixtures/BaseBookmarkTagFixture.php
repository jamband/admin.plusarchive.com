<?php

declare(strict_types=1);

namespace app\tests\fixtures;

use app\models\BookmarkTag;
use yii\test\ActiveFixture;

class BaseBookmarkTagFixture extends ActiveFixture
{
    public $modelClass = BookmarkTag::class;

    protected function getData(): array
    {
        return [
            'tag1' => [
                'name' => 'tag1',
                'frequency' => 1,
                'created_at' => time(),
                'updated_at' => time(),
            ],
            'tag2' => [
                'name' => 'tag2',
                'frequency' => 1,
                'created_at' => time(),
                'updated_at' => time(),
            ],
        ];
    }
}
