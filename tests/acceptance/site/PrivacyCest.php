<?php

declare(strict_types=1);

namespace app\tests\acceptance\site;

use AcceptanceTester;
use app\controllers\site\PrivacyController;
use yii\helpers\Url;

/**
 * @noinspection PhpUnused
 * @see PrivacyController
 */
class PrivacyCest
{
    /**
     * @noinspection PhpUnused
     */
    public function ensureThatPrivacyWorks(AcceptanceTester $I): void
    {
        $I->amOnPage(Url::toRoute('/privacy'));
        $I->see('Privacy Policy', 'h1');
    }
}
