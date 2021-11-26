<?php

declare(strict_types=1);

namespace app\tests\unit\fixtures\label;

use yii\test\ActiveFixture;

class LabelTagAssnFixture extends ActiveFixture
{
    public $tableName = 'label_tag_assn';

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
