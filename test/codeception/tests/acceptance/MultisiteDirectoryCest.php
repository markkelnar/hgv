<?php
use \AcceptanceTester;

class MultisiteDirectoryCest
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
        $I->amOnUrl('http://multidirectory.test');
        // Check the backend processor is what we expected
        $I->assertRegExp('#HHVM/(.*)#', $I->grabHttpHeader('X-Powered-By'));
        $I->seeResponseCodeIs(200);
    }

    public function viewSubpageHHVM(AcceptanceTester $I)
    {
        $I->amOnUrl('http://multidirectory.test');
        $I->assertRegExp('#HHVM/(.*)#', $I->grabHttpHeader('X-Powered-By'));
        $I->amOnPage('/foo/');
        $I->seeCurrentUrlEquals('/foo/');
        $I->seeResponseCodeIs(200);
    }

    public function viewPagePHP(AcceptanceTester $I)
    {
        // Pass header/cookie to specify the backend
        $I->setCookie('backend', 'php');
        $I->amOnUrl('http://multidirectory.test');
        $I->assertRegExp('#PHP/(.*)#', $I->grabHttpHeader('X-Powered-By'));
        $I->seeResponseCodeIs(200);
    }

    public function viewPagePHP7(AcceptanceTester $I)
    {
        // Pass header/cookie to specify the backend
        $I->setCookie('backend', 'php7');
        $I->amOnUrl('http://multidirectory.test');
        $I->assertRegExp('#PHP/7\.(.*)#', $I->grabHttpHeader('X-Powered-By'));
        $I->seeResponseCodeIs(200);
    }

    public function viewSubpagePHP(AcceptanceTester $I)
    {
        // Pass header/cookie to specify the backend
        $I->setCookie('backend', 'php');
        $I->amOnUrl('http://multidirectory.test');
        $I->assertRegExp('#PHP/(.*)#', $I->grabHttpHeader('X-Powered-By'));
        $I->amOnPage('/foo/');
        $I->seeCurrentUrlEquals('/foo/');
        $I->seeResponseCodeIs(200);
    }

    public function viewSubpagePHP7(AcceptanceTester $I)
    {
        // Pass header/cookie to specify the backend
        $I->setCookie('backend', 'php7');
        $I->amOnUrl('http://multidirectory.test');
        $I->assertRegExp('#PHP/7\.(.*)#', $I->grabHttpHeader('X-Powered-By'));
        $I->amOnPage('/foo/');
        $I->seeCurrentUrlEquals('/foo/');
        $I->seeResponseCodeIs(200);
    }

    public function viewPageHHVM404(AcceptanceTester $I)
    {
        $I->amOnUrl('http://multidirectory.test');
        $I->amOnPage('/bar');
        $I->seeResponseCodeIs(404);
    }

    public function viewPagePHP404(AcceptanceTester $I)
    {
        // Pass header/cookie to specify the backend
        $I->setCookie('backend', 'php');
        $I->amOnUrl('http://multidirectory.test');
        $I->assertRegExp('#PHP/(.*)#', $I->grabHttpHeader('X-Powered-By'));
        $I->amOnPage('/bar');
        $I->seeResponseCodeIs(404);
    }

    public function viewPagePHP7_404(AcceptanceTester $I)
    {
        // Pass header/cookie to specify the backend
        $I->setCookie('backend', 'php7');
        $I->amOnUrl('http://multidirectory.test');
        $I->assertRegExp('#PHP/7\.(.*)#', $I->grabHttpHeader('X-Powered-By'));
        $I->amOnPage('/bar');
        $I->seeResponseCodeIs(404);
    }

}
