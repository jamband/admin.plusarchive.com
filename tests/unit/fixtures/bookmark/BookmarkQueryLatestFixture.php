<?php

declare(strict_types=1);

namespace app\tests\unit\fixtures\bookmark;

use app\tests\fixtures\BaseBookmarkFixture;

class BookmarkQueryLatestFixture extends BaseBookmarkFixture
{
    protected function getData(): array
    {
        return [
            'bookmark1' => [
                'name' => 'bookmark1',
                'country' => 'Japan',
                'url' => 'https://bookmark1.com/',
                'link' => 'https://twitter.com/bookmark1',
                'created_at' => time() + 3,
                'updated_at' => time(),
            ],
            'bookmark2' => [
                'name' => 'bookmark2',
                'country' => 'Japan',
                'url' => 'https://bookmark2.com/',
                'link' => 'https://twitter.com/bookmark2',
                'created_at' => time() + 1,
                'updated_at' => time(),
            ],
            'bookmark3' => [
                'name' => 'bookmark3',
                'country' => 'Japan',
                'url' => 'https://bookmark3.com/',
                'link' => 'https://twitter.com/bookmark3',
                'created_at' => time() + 2,
                'updated_at' => time(),
            ],
        ];
    }
}
