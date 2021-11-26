<?php

declare(strict_types=1);

namespace app\tests\unit\fixtures\label;

use app\models\LabelTag;
use yii\test\ActiveFixture;

class LabelTagFixture extends ActiveFixture
{
    public $modelClass = LabelTag::class;

    protected function getData(): array
    {
        return [
            'tag1' => [
                'name' => 'tag1',
                'frequency' => 1,
                'created_at' => time(),
                'updated_at' => time(),
            ],
            'tag2' => [
                'name' => 'tag2',
                'frequency' => 1,
                'created_at' => time(),
                'updated_at' => time(),
            ],
        ];
    }
}
