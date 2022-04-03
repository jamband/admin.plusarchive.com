<?php

declare(strict_types=1);

namespace app\tests\acceptance\fixtures;

use app\tests\fixtures\BaseUserFixture;

class LoginFixture extends BaseUserFixture
{
    public $depends = [
        AdminUserFixture::class,
    ];
}
