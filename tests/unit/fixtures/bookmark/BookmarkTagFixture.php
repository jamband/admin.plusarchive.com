<?php

declare(strict_types=1);

namespace app\tests\unit\fixtures\bookmark;

use app\tests\fixtures\BaseBookmarkTagFixture;

class BookmarkTagFixture extends BaseBookmarkTagFixture
{
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
