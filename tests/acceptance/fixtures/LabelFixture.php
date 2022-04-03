<?php

declare(strict_types=1);

namespace app\tests\acceptance\fixtures;

use app\tests\fixtures\BaseLabelFixture;

class LabelFixture extends BaseLabelFixture
{
    public $depends = [
        AdminUserFixture::class,
    ];

    protected function getData(): array
    {
        return [
            'label1' => [
                'name' => 'label1',
                'country' => 'Japan',
                'url' => 'https://label1.example.com/',
                'link' => "https://twitter.com/label1records\nhttps://soundcloud.com/label1records",
                'created_at' => time(),
                'updated_at' => time(),
            ],
            'label2' => [
                'name' => 'label2',
                'country' => 'US',
                'url' => 'https://label2.example.com/',
                'link' => "https://twitter.com/label2records\nhttps://soundcloud.com/label2records",
                'created_at' => time(),
                'updated_at' => time(),
            ],
            'label3' => [
                'name' => 'label3',
                'country' => 'UK',
                'url' => 'https://label3.example.com/',
                'link' => 'https://www.youtube.com/user/label3',
                'created_at' => time(),
                'updated_at' => time(),
            ],
        ];
    }
}
