<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace app\tests\unit\fixtures\label;

class LabelQueryCountryFixture extends LabelFixture
{
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
            'label4' => [
                'name' => 'label4',
                'country' => 'Japan',
                'url' => 'https://label4.com/',
                'link' => 'https://www.youtube.com/user/label4',
                'created_at' => time(),
                'updated_at' => time(),
            ],
        ];
    }
}
