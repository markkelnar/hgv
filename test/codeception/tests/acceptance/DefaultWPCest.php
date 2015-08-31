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

    /**
     * This test will check the file upload size limit in wp-admin media uploader
     */
    public function checkFileUploadLimitHHVM(AcceptanceTester $I)
    {
        $I->wantTo('Log into site and check file upload on media page');
        $I->amOnUrl('http://hhvm.hgv.test');
        $I->amOnPage('/wp-login.php');
        $I->fillField('log', 'wordpress');
        $I->fillField('pwd', 'wordpress');
        $I->click('Log In');

        $I->amOnPage('/wp-admin/media-new.php');
        $I->see('Maximum upload file size: 200 MB.');
    }

    /**
     * This test will check the file upload size limit in wp-admin media uploader
     */
    public function checkFileUploadLimitPHP(AcceptanceTester $I)
    {
        $I->wantTo('Log into site and check file upload on media page');
        $I->amOnUrl('http://php.hgv.test');
        $I->amOnPage('/wp-login.php');
        $I->fillField('log', 'wordpress');
        $I->fillField('pwd', 'wordpress');
        $I->click('Log In');

        $I->amOnPage('/wp-admin/media-new.php');
        $I->see('Maximum upload file size: 200 MB.');
    }
}
