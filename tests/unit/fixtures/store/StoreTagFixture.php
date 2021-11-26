<?php

declare(strict_types=1);

namespace app\tests\unit\fixtures\store;

use app\models\StoreTag;
use yii\test\ActiveFixture;

class StoreTagFixture extends ActiveFixture
{
    public $modelClass = StoreTag::class;

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
