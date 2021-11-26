<?php

declare(strict_types=1);

namespace app\tests\acceptance\fixtures;

use app\models\BookmarkTag;
use yii\test\ActiveFixture;

class BookmarkTagFixture extends ActiveFixture
{
    public $modelClass = BookmarkTag::class;

    public $depends = [
        AdminUserFixture::class,
    ];

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
            'tag3' => [
                'name' => 'tag3',
                'frequency' => 1,
                'created_at' => time(),
                'updated_at' => time(),
            ],
        ];
    }
}
