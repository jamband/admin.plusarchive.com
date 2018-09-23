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

use app\models\Store;
use yii\test\ActiveFixture;

class StoreFixture extends ActiveFixture
{
    public $modelClass = Store::class;

    public $depends = [
        AdminUserFixture::class,
    ];

    protected function getData(): array
    {
        return [
            'store1' => [
                'name' => 'store1',
                'country' => 'Japan',
                'url' => 'https://store1.example.com/',
                'link' => "https://twitter.com/store1\nhttps://soundcloud.com/store1",
                'created_at' => time(),
                'updated_at' => time(),
            ],
            'store2' => [
                'name' => 'store2',
                'country' => 'US',
                'url' => 'https://store2.example.com/',
                'link' => "https://twitter.com/store2\nhttps://soundcloud.com/store2",
                'created_at' => time(),
                'updated_at' => time(),
            ],
            'store3' => [
                'name' => 'store3',
                'country' => 'UK',
                'url' => 'https://store3.example.com/',
                'link' => 'https://www.youtube.com/user/store3',
                'created_at' => time(),
                'updated_at' => time(),
            ],
        ];
    }
}
