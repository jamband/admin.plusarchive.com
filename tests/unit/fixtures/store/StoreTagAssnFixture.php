<?php

declare(strict_types=1);

namespace app\tests\unit\fixtures\store;

use app\tests\fixtures\BaseStoreTagAssnFixture;

class StoreTagAssnFixture extends BaseStoreTagAssnFixture
{
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
