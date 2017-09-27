<?php

class BackendCookieCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function _after(AcceptanceTester $I)
    {
    }

    // Test that can load the default WP with PHP 5.6
    public function viewPageCookiePHP(AcceptanceTester $I)
    {
        $I->setCookie('backend', 'php');
        $I->amOnUrl('http://hhvm.hgv.test');
        $I->amOnPage('/');
        $I->seeCurrentUrlEquals('/');
        $I->seeResponseCodeIs(200);
        $I->assertRegExp('#PHP/5\.6\.(.*)#', $I->grabHttpHeader('X-Powered-By'));
    }

    // Test that can load the default WP with PHP 5.6
    public function viewPageCookiePHP5(AcceptanceTester $I)
    {
        $I->setCookie('backend', 'php5');
        $I->amOnUrl('http://hhvm.hgv.test');
        $I->amOnPage('/');
        $I->seeCurrentUrlEquals('/');
        $I->seeResponseCodeIs(200);
        $I->assertRegExp('#PHP/5\.6\.(.*)#', $I->grabHttpHeader('X-Powered-By'));
    }

    // Test that can load the default WP with PHP 5.6
    public function viewPageCookiePHP55(AcceptanceTester $I)
    {
        $I->setCookie('backend', 'php55');
        $I->amOnUrl('http://hhvm.hgv.test');
        $I->amOnPage('/');
        $I->seeCurrentUrlEquals('/');
        $I->seeResponseCodeIs(200);
        $I->assertRegExp('#PHP/5\.6\.(.*)#', $I->grabHttpHeader('X-Powered-By'));
    }

    // Test that can load the default WP with PHP 5.6
    public function viewPageCookiePHP56(AcceptanceTester $I)
    {
        $I->setCookie('backend', 'php56');
        $I->amOnUrl('http://hhvm.hgv.test');
        $I->amOnPage('/');
        $I->seeCurrentUrlEquals('/');
        $I->seeResponseCodeIs(200);
        $I->assertRegExp('#PHP/5\.6\.(.*)#', $I->grabHttpHeader('X-Powered-By'));
    }

    // Test that can load the default WP with PHP 7.0
    public function viewPageCookiePHP70(AcceptanceTester $I)
    {
        $I->setCookie('backend', 'php7');
        $I->amOnUrl('http://hhvm.hgv.test');
        $I->amOnPage('/');
        $I->seeCurrentUrlEquals('/');
        $I->seeResponseCodeIs(200);
        $I->assertRegExp('#PHP/7\.0\.(.*)#', $I->grabHttpHeader('X-Powered-By'));
    }

    // Test that can load the default WP with PHP 7.1
    public function viewPageCookiePHP71(AcceptanceTester $I)
    {
        $I->setCookie('backend', 'php71');
        $I->amOnUrl('http://hhvm.hgv.test');
        $I->amOnPage('/');
        $I->seeCurrentUrlEquals('/');
        $I->seeResponseCodeIs(200);
        $I->assertRegExp('#PHP/7\.1\.(.*)#', $I->grabHttpHeader('X-Powered-By'));
    }

    // Test that can load the default WP with HHVM
    public function viewPageCookieHHVM(AcceptanceTester $I)
    {
        $I->setCookie('backend', 'hhvm');
        $I->amOnUrl('http://hhvm.hgv.test');
        $I->amOnPage('/');
        $I->seeCurrentUrlEquals('/');
        $I->seeResponseCodeIs(200);
        $I->assertRegExp('#HHVM(.*)#', $I->grabHttpHeader('X-Powered-By'));
    }
}
