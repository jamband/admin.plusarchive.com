<?php

declare(strict_types=1);

namespace app\tests\acceptance\site;

use AcceptanceTester;
use app\controllers\site\AboutController;
use yii\helpers\Url;

/**
 * @noinspection PhpUnused
 * @see AboutController
 */
class AboutCest
{
    /**
     * @noinspection PhpUnused
     */
    public function ensureThatAboutWorks(AcceptanceTester $I): void
    {
        $I->amOnPage(Url::toRoute('/about'));
        $I->see('About', 'h1');
    }
}
