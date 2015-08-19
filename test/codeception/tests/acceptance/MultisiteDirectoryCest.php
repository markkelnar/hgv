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
        $I->amOnPage('/foo/');
        $I->seeCurrentUrlEquals('/foo/');
        $I->seeResponseCodeIs(200);
    }

    public function viewPagePHP(AcceptanceTester $I)
    {
        $I->amOnUrl('http://phpmultidirectory.test');
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
        $I->amOnUrl('http://phpmultidirectory.test');
        $I->amOnPage('/bar');
        $I->seeResponseCodeIs(404);
    }

}
