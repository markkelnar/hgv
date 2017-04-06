<?php
use \AcceptanceTester;

// TODO: These tests are duplicate for hhvm and php. Probably a good idea to refactor these tests so there is one set of tests and each domain endpoint is extended to call the test suite.
class DefaultWPCest
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
        $I->amOnUrl('http://hhvm.hgv.test');
        $I->amOnPage('/');
        $I->seeCurrentUrlEquals('/');
        $I->seeResponseCodeIs(200);
        $I->assertRegExp('#HHVM(.*)#', $I->grabHttpHeader('X-Powered-By'));
    }

    public function viewPageHHVMcache(AcceptanceTester $I)
    {
        $I->amOnUrl('http://cache.hhvm.hgv.test');
        $I->amOnPage('/');
        $I->seeCurrentUrlEquals('/');
        $I->seeResponseCodeIs(200);
    }

    public function viewPagePHP(AcceptanceTester $I)
    {
        $I->amOnUrl('http://php.hgv.test');
        $I->amOnPage('/');
        $I->seeCurrentUrlEquals('/');
        $I->seeResponseCodeIs(200);
    }

    public function viewPagePHPcache(AcceptanceTester $I)
    {
        $I->amOnUrl('http://cache.php.hgv.test');
        $I->amOnPage('/');
        $I->seeCurrentUrlEquals('/');
        $I->seeResponseCodeIs(200);
    }
}
