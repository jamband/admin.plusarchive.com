<?php

declare(strict_types=1);

namespace app\tests\unit\fixtures\store;

use app\tests\fixtures\BaseStoreFixture;

class StoreQueryBehaviorsFixture extends BaseStoreFixture
{
    public $depends = [
        StoreTagFixture::class,
        StoreTagAssnFixture::class,
    ];

    protected function getData(): array
    {
        return [
            'store1' => [
                'name' => 'store1',
                'country' => 'Japan',
                'url' => 'https://store1.com/',
                'link' => "https://twitter.com/store1\nhttps://soundcloud.com/store1",
                'created_at' => time(),
                'updated_at' => time(),
            ],
            'store2' => [
                'name' => 'store2',
                'country' => 'US',
                'url' => 'https://store2.com/',
                'link' => "https://twitter.com/store2\nhttps://soundcloud.com/store2",
                'created_at' => time(),
                'updated_at' => time(),
            ],
            'store3' => [
                'name' => 'store3',
                'country' => 'UK',
                'url' => 'https://store3.com/',
                'link' => "https://twitter.com/store3\nhttps://soundcloud.com/store3",
                'created_at' => time(),
                'updated_at' => time(),
            ],
        ];
    }
}
