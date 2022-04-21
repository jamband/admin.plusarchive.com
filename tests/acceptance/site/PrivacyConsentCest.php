<?php

declare(strict_types=1);

namespace app\tests\acceptance\site;

use AcceptanceTester;
use app\controllers\site\PrivacyConsentController;
use Yii;
use yii\helpers\Url;

/**
 * @noinspection PhpUnused
 * @see PrivacyConsentController
 */
class PrivacyConsentCest
{
    /**
     * @noinspection PhpUnused
     */
    public function ensureThatPrivacyConsentWorks(AcceptanceTester $I): void
    {
        $I->seeBadRequest('/privacy-consent');

        $I->amOnPage(Url::toRoute('/'));
        $I->click('Privacy Policy', 'footer');
        $I->seeCurrentUrlEquals(Url::toRoute('/privacy'));

        $I->click('ACCEPT', 'footer');
        $I->waitForText(Yii::$app->name, selector: 'footer');
    }
}
