<?php
use \AcceptanceTester;

class DashboardCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function _after(AcceptanceTester $I)
    {
    }

    // tests
    // Check that the dashboard doesn't contain legacy url
    public function home(AcceptanceTester $I)
    {
        $I->amOnUrl('http://hgv.test');
    }

    public function viewAdmin(AcceptanceTester $I)
    {
        $I->amOnUrl('http://admin.hgv.test');
        $I->seeResponseCodeIs(200);
    }

    public function viewPhpmyadmin(AcceptanceTester $I)
    {
        $I->amOnUrl('http://admin.hgv.test/phpmyadmin');
        $I->seeResponseCodeIs(200);
        $I->see('Welcome to <bdo dir="ltr" lang="en">phpMyAdmin</bdo>');
    }

    public function viewPhpmemcachedadmin(AcceptanceTester $I)
    {
        $I->amOnUrl('http://admin.hgv.test/phpmemcachedadmin');
        $I->seeResponseCodeIs(200);
        $I->see('phpMemcachedAdmin', '//head/title');
    }

}
