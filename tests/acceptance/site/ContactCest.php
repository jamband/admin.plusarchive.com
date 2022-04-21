<?php

declare(strict_types=1);

namespace app\tests\acceptance\site;

use AcceptanceTester;
use app\controllers\site\ContactController;
use yii\helpers\Url;

/**
 * @noinspection PhpUnused
 * @see ContactController
 */
class ContactCest
{
    /**
     * @noinspection PhpUnused
     */
    public function ensureThatContactWorks(AcceptanceTester $I): void
    {
        $I->amOnPage(Url::toRoute('/contact'));
        $I->see('Contact', 'h1');
    }
}
