<?php
use \AcceptanceTester;

class ErrorPageCest
{
    public function _before(AcceptanceTester $I)
    {
        $file = '/nas/wp/www/sites/hhvm/test-error-500.php';
        $content = '<?php header("HTTP/1.1 500 Internal Server Error");';
        $I->writeToFile($file, $content);
    }

    public function _after(AcceptanceTester $I)
    {
        $file = '/nas/wp/www/sites/hhvm/test-error-500.php';
        $I->deleteFile($file);
    }

    /**
     * Cause a deliberate 500 error and verify the page does not redirect because not using the cookie.
     */
    public function errorPage500no(AcceptanceTester $I)
    {
        $I->wantTo('Load special error page and get error');
        $I->amOnUrl('http://hhvm.hgv.test');
        $I->amOnPage('/test-error-500.php');
        $I->seeResponseCodeIs(500);
    }

    /**
     * Cause a deliberate 500 error and verify the page is redirected to the special error page.
     */
    public function errorPage500yes(AcceptanceTester $I)
    {
        $I->wantTo('Load special error page and get redirect to our error page');
        $I->setCookie('backend', 'php7');
        $I->amOnUrl('http://hhvm.hgv.test');
        $I->amOnPage('/test-error-500.php');
        $I->seeResponseCodeIs(500);
        $I->seeCurrentUrlEquals('/test-error-500.php');
        $I->see('You are seeing this because you are using the PHP selector, and the page you are working on just returned an error.');
    }
}
