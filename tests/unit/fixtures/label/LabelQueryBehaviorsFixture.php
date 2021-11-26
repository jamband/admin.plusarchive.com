<?php

declare(strict_types=1);

namespace app\tests\unit\fixtures\label;

class LabelQueryBehaviorsFixture extends LabelFixture
{
    public $depends = [
        LabelTagFixture::class,
        LabelTagAssnFixture::class,
    ];

    protected function getData(): array
    {
        return [
            'label1' => [
                'name' => 'label1',
                'country' => 'Japan',
                'url' => 'https://label1.com/',
                'link' => "https://twitter.com/label1\nhttps://soundcloud.com/label1",
                'created_at' => time(),
                'updated_at' => time(),
            ],
            'label2' => [
                'name' => 'label2',
                'country' => 'US',
                'url' => 'https://label2.com/',
                'link' => "https://twitter.com/label2\nhttps://soundcloud.com/label2",
                'created_at' => time(),
                'updated_at' => time(),
            ],
            'label3' => [
                'name' => 'label3',
                'country' => 'UK',
                'url' => 'https://label3.com/',
                'link' => "https://twitter.com/label3\nhttps://soundcloud.com/label3",
                'created_at' => time(),
                'updated_at' => time(),
            ],
        ];
    }
}
