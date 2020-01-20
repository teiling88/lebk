<?php 

class OverviewPageCest
{
    // tests
    public function tryToTestBasicOverview(AcceptanceTester $I): void
    {
        $I->amOnPage('/index.php');
        $I->see('Weekly Reports');
    }

}
