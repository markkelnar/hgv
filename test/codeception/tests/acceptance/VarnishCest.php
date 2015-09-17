<?php
use \AcceptanceTester;

class VarnishCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function _after(AcceptanceTester $I)
    {
    }

    // tests
    public function configExists(AcceptanceTester $I)
    {
        $I->wantTo('Check for existance of config file');
        $I->seeFileFound('default.vcl', '/etc/varnish/');
    }
}
