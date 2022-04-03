<?php

declare(strict_types=1);

namespace app\tests\acceptance\fixtures;

use app\tests\fixtures\BaseUserFixture;

class SignupFixture extends BaseUserFixture
{
    public $depends = [
        AdminUserFixture::class,
    ];
}
