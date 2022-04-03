<?php

declare(strict_types=1);

namespace app\tests\unit\fixtures\bookmark;

use app\tests\fixtures\BaseBookmarkFixture;

class BookmarkQueryBehaviorsFixture extends BaseBookmarkFixture
{
    public $depends = [
        BookmarkTagFixture::class,
        BookmarkTagAssnFixture::class,
    ];

    protected function getData(): array
    {
        return [
            'bookmark1' => [
                'name' => 'bookmark1',
                'country' => 'Japan',
                'url' => 'https://bookmark1.com/',
                'link' => "https://twitter.com/bookmark1\nhttps://soundcloud.com/bookmark1",
                'created_at' => time(),
                'updated_at' => time(),
            ],
            'bookmark2' => [
                'name' => 'bookmark2',
                'country' => 'US',
                'url' => 'https://bookmark2.com/',
                'link' => "https://twitter.com/bookmark2\nhttps://soundcloud.com/bookmark2",
                'created_at' => time(),
                'updated_at' => time(),
            ],
            'bookmark3' => [
                'name' => 'bookmark3',
                'country' => 'UK',
                'url' => 'https://bookmark3.com/',
                'link' => "https://twitter.com/bookmark3\nhttps://soundcloud.com/bookmark3",
                'created_at' => time(),
                'updated_at' => time(),
            ],
        ];
    }
}
