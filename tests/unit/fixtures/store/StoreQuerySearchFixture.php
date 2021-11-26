<?php

declare(strict_types=1);

namespace app\tests\unit\fixtures\store;

class StoreQuerySearchFixture extends StoreFixture
{
    protected function getData(): array
    {
        return [
            'store1' => [
                'name' => 'foo',
                'country' => 'Japan',
                'url' => 'https://foo.com/',
                'link' => "https://twitter.com/foo\nhttps://soundcloud.com/foo",
                'created_at' => time(),
                'updated_at' => time(),
            ],
            'store2' => [
                'name' => 'bar',
                'country' => 'US',
                'url' => 'https://bar.com/',
                'link' => "https://twitter.com/bar",
                'created_at' => time(),
                'updated_at' => time(),
            ],
            'store3' => [
                'name' => 'baz',
                'country' => 'UK',
                'url' => 'https://baz.com/',
                'link' => "https://twitter.com/baz\nhttps://soundcloud.com/baz",
                'created_at' => time(),
                'updated_at' => time(),
            ],
        ];
    }
}
