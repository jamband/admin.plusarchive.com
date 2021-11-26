<?php

declare(strict_types=1);

namespace app\tests\unit\fixtures\store;

use yii\test\ActiveFixture;

class StoreTagAssnFixture extends ActiveFixture
{
    public $tableName = 'store_tag_assn';

    protected function getData(): array
    {
        return [
            'tag_assn1' => [
                'store_id' => 1,
                'store_tag_id' => 1,
            ],
        ];
    }
}
