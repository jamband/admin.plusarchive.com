<?php

declare(strict_types=1);

namespace app\tests\unit\fixtures\bookmark;

use app\tests\fixtures\BaseBookmarkTagAssnFixture;

class BookmarkTagAssnFixture extends BaseBookmarkTagAssnFixture
{
    protected function getData(): array
    {
        return [
            'tag_assn1' => [
                'bookmark_id' => 1,
                'bookmark_tag_id' => 1,
            ],
        ];
    }
}
