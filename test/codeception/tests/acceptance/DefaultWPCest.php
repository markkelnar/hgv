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

    // Test that can load the default WP with PHP 7
    public function viewPagePHP7(AcceptanceTester $I)
    {
        $I->setCookie('backend', 'php7');
        $I->amOnUrl('http://hhvm.hgv.test');
        $I->amOnPage('/');
        $I->seeCurrentUrlEquals('/');
        $I->seeResponseCodeIs(200);
        $I->assertRegExp('#PHP/7\.(.*)#', $I->grabHttpHeader('X-Powered-By'));
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

    /**
     * This test will check the file upload size limit in wp-admin media uploader
     */
    public function checkFileUploadLimitPHP7(AcceptanceTester $I)
    {
        $I->wantTo('Log into site and check file upload on media page');
        $I->setCookie('backend', 'php7');
        $I->amOnUrl('http://php.hgv.test');
        $I->amOnPage('/wp-login.php');
        $I->assertRegExp('#PHP/7\.(.*)#', $I->grabHttpHeader('X-Powered-By'));
        $I->fillField('log', 'wordpress');
        $I->fillField('pwd', 'wordpress');
        $I->click('Log In');

        $I->amOnPage('/wp-admin/media-new.php');
        $I->see('Maximum upload file size: 200 MB.');
    }

    /**
     * Cause a deliberate 500 error and verify the page does not redirect because not using the cookie.
     */
    public function errorPage500no(AcceptanceTester $I)
    {
        $file = '/nas/wp/www/sites/hhvm/test-error-500.php';
        $content = '<?php header("HTTP/1.1 500 Internal Server Error");';
        $I->writeToFile($file, $content);

        $I->wantTo('Load special error page and get error');
        $I->amOnUrl('http://hhvm.hgv.test');
        $I->amOnPage('/test-error-500.php');
        $I->seeResponseCodeIs(500);

        $I->deleteFile($file);
    }

    /**
     * Cause a deliberate 500 error and verify the page is redirected to the special error page.
     */
    public function errorPage500yes(AcceptanceTester $I)
    {
        $file = '/nas/wp/www/sites/hhvm/test-error-500.php';
        $content = '<?php header("HTTP/1.1 500 Internal Server Error");';
        $I->writeToFile($file, $content);

        $I->wantTo('Load special error page and get redirect to our error page');
        $I->setCookie('backend', 'php7');
        $I->amOnUrl('http://hhvm.hgv.test');
        $I->amOnPage('/test-error-500.php');
        $I->seeResponseCodeIs(500);
        $I->seeCurrentUrlEquals('/test-error-500.php');

        $I->deleteFile($file);
    }

}
