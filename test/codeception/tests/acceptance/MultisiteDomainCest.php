<?php
use \AcceptanceTester;

class MultisiteDomainCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function _after(AcceptanceTester $I)
    {
    }

    // tests
    public function viewPageHHVM(AcceptanceTester $I)
    {
        $I->amOnUrl('http://multidomain.test');
        $I->amOnPage('/');
        $I->seeCurrentUrlEquals('/');
        $I->seeResponseCodeIs(200);
    }

    public function viewPagePHP(AcceptanceTester $I)
    {
        $I->amOnUrl('http://php.multidomain.test');
        $I->amOnPage('/');
        $I->seeCurrentUrlEquals('/');
        $I->seeResponseCodeIs(200);
    }

    public function viewPageHHVM404(AcceptanceTester $I)
    {
        $I->amOnUrl('http://multidomain.test');
        $I->amOnPage('/not-exist');
        $I->seeResponseCodeIs(404);
    }

}
