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
        $I->amOnPage(Url::to(['/site/about/index']));
        $I->see('About', 'h1');
    }
}
