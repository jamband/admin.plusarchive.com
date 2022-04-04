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
        $I->seeBadRequest(['/site/privacy-consent/index']);

        $I->amOnPage(Url::to(['/']));
        $I->click('Privacy Policy', 'footer');
        $I->seeCurrentUrlEquals('/index-test.php/privacy');

        $I->click('ACCEPT', 'footer');
        $I->waitForText(Yii::$app->name, selector: 'footer');
    }
}
