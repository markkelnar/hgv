<?php

class UploadSizeWPCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function _after(AcceptanceTester $I)
    {
    }

    /**
     * This test will check the file upload size limit in wp-admin media uploader
     */
    public function checkFileUploadLimitPhp(AcceptanceTester $I)
    {
        $I->wantTo('Log into site and check file upload on media page PHP 5.5');
        $I->setCookie('backend', 'php');
        $I->amOnUrl('http://hhvm.hgv.test');
        $I->amOnPage('/wp-login.php');
        $I->fillField('log', 'wordpress');
        $I->fillField('pwd', 'wordpress');
        $I->click('Log In');

        $I->amOnPage('/wp-admin/media-new.php');
        $I->assertRegExp('#PHP/5\.6\.(.*)#', $I->grabHttpHeader('X-Powered-By'));
        $I->see('Maximum upload file size: 200 MB.');
    }

    /**
     * This test will check the file upload size limit in wp-admin media uploader
     */
    public function checkFileUploadLimitPhp56(AcceptanceTester $I)
    {
        $I->wantTo('Log into site and check file upload on media page PHP 5.6');
        $I->setCookie('backend', 'php56');
        $I->amOnUrl('http://hhvm.hgv.test');
        $I->amOnPage('/wp-login.php');
        $I->fillField('log', 'wordpress');
        $I->fillField('pwd', 'wordpress');
        $I->click('Log In');

        $I->amOnPage('/wp-admin/media-new.php');
        $I->assertRegExp('#PHP/5\.6\.(.*)#', $I->grabHttpHeader('X-Powered-By'));
        $I->see('Maximum upload file size: 200 MB.');
    }

    /**
     * This test will check the file upload size limit in wp-admin media uploader
     */
    public function checkFileUploadLimitPhp70(AcceptanceTester $I)
    {
        $I->wantTo('Log into site and check file upload on media page PHP 7.0');
        $I->setCookie('backend', 'php7');
        $I->amOnUrl('http://hhvm.hgv.test');
        $I->amOnPage('/wp-login.php');
        $I->fillField('log', 'wordpress');
        $I->fillField('pwd', 'wordpress');
        $I->click('Log In');

        $I->amOnPage('/wp-admin/media-new.php');
        $I->assertRegExp('#PHP/7\.0\.(.*)#', $I->grabHttpHeader('X-Powered-By'));
        $I->see('Maximum upload file size: 200 MB.');
    }

    /**
     * This test will check the file upload size limit in wp-admin media uploader
     */
    public function checkFileUploadLimitPhp71(AcceptanceTester $I)
    {
        $I->wantTo('Log into site and check file upload on media page PHP 7.1');
        $I->setCookie('backend', 'php71');
        $I->amOnUrl('http://hhvm.hgv.test');
        $I->amOnPage('/wp-login.php');
        $I->fillField('log', 'wordpress');
        $I->fillField('pwd', 'wordpress');
        $I->click('Log In');

        $I->amOnPage('/wp-admin/media-new.php');
        $I->assertRegExp('#PHP/7\.1\.(.*)#', $I->grabHttpHeader('X-Powered-By'));
        $I->see('Maximum upload file size: 200 MB.');
    }
}
