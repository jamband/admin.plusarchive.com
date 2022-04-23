<?php

declare(strict_types=1);

namespace app\tests\unit\fixtures\label;

use app\tests\fixtures\BaseLabelFixture;

class LabelQueryLatestFixture extends BaseLabelFixture
{
    protected function getData(): array
    {
        return [
            'label1' => [
                'name' => 'label1',
                'country' => 'Japan',
                'url' => 'https://label1.com/',
                'link' => 'https://twitter.com/label1',
                'created_at' => time() + 3,
                'updated_at' => time(),
            ],
            'label2' => [
                'name' => 'label2',
                'country' => 'Japan',
                'url' => 'https://label2.com/',
                'link' => 'https://twitter.com/label2',
                'created_at' => time() + 1,
                'updated_at' => time(),
            ],
            'label3' => [
                'name' => 'label3',
                'country' => 'Japan',
                'url' => 'https://label3.com/',
                'link' => 'https://twitter.com/label3',
                'created_at' => time() + 2,
                'updated_at' => time(),
            ],
        ];
    }
}
