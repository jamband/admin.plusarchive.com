<?php

declare(strict_types=1);

namespace app\tests\unit\fixtures\label;

use app\tests\fixtures\BaseLabelTagAssnFixture;

class LabelTagAssnFixture extends BaseLabelTagAssnFixture
{
    protected function getData(): array
    {
        return [
            'tag_assn1' => [
                'label_id' => 1,
                'label_tag_id' => 1,
            ],
        ];
    }
}
