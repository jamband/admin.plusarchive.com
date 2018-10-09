<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace app\tests\acceptance\fixtures;

use app\models\Bookmark;
use yii\test\ActiveFixture;

class BookmarkFixture extends ActiveFixture
{
    public $modelClass = Bookmark::class;

    public $depends = [
        AdminUserFixture::class,
    ];

    protected function getData(): array
    {
        return [
            'bookmark1' => [
                'name' => 'bookmark1',
                'country' => 'Japan',
                'url' => 'https://bookmark1.example.com/',
                'link' => "https://twitter.com/bookmark1\nhttps://soundcloud.com/bookmark1",
                'created_at' => time(),
                'updated_at' => time(),
            ],
            'bookmark2' => [
                'name' => 'bookmark2',
                'country' => 'US',
                'url' => 'https://bookmark2.example.com/',
                'link' => "https://twitter.com/bookmark2\nhttps://soundcloud.com/bookmark2",
                'created_at' => time(),
                'updated_at' => time(),
            ],
            'bookmark3' => [
                'name' => 'bookmark3',
                'country' => 'UK',
                'url' => 'https://bookmark3.example.com/',
                'link' => "https://twitter.com/bookmark3\nhttps://soundcloud.com/bookmark3",
                'created_at' => time(),
                'updated_at' => time(),
            ],
            'bookmark4' => [
                'name' => 'bookmark4',
                'country' => 'Japan',
                'url' => 'https://bookmark4.example.com/',
                'link' => 'https://www.youtube.com/user/bookmark4',
                'created_at' => time(),
                'updated_at' => time(),
            ],
        ];
    }
}
