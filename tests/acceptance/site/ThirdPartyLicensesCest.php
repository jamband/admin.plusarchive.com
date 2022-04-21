<?php

declare(strict_types=1);

namespace app\tests\acceptance\site;

use AcceptanceTester;
use app\controllers\site\ThirdPartyLicensesController;
use yii\helpers\Url;

/**
 * @noinspection PhpUnused
 * @see ThirdPartyLicensesController
 */
class ThirdPartyLicensesCest
{
    /**
     * @noinspection PhpUnused
     */
    public function ensureThatThirdPartyLicensesWorks(AcceptanceTester $I): void
    {
        $I->amOnPage(Url::toRoute('/third-party-licenses'));
        $I->see('Third-Party Licenses', 'h1');
        $I->see('jquery');
    }
}
