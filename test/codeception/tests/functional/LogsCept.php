<?php 
$I = new FunctionalTester($scenario);
$I->wantTo('Check for existance of log files');
$I->seeFileFound('hhvm.access.log', '/var/log/nginx/');
$I->seeFileFound('hhvm.apachestyle.access.log', '/var/log/nginx/');
$I->seeFileFound('hhvm.error.log', '/var/log/nginx/');
$I->seeFileFound('cache.hhvm.access.log', '/var/log/nginx/');
$I->seeFileFound('cache.hhvm.apachestyle.access.log', '/var/log/nginx/');
$I->seeFileFound('cache.hhvm.error.log', '/var/log/nginx/');

$I->wantTo('Check for the absence of legacy log files');
$I->dontSeeFileFound('hhvm-hhvm.access.log', '/var/log/nginx/');
$I->dontSeeFileFound('hhvm-hhvm.apachestyle.access.log', '/var/log/nginx/');
$I->dontSeeFileFound('hhvm-hhvm.error.log', '/var/log/nginx/');
$I->dontSeeFileFound('hhvm-php.access.log', '/var/log/nginx/');
$I->dontSeeFileFound('hhvm-php.apachestyle.access.log', '/var/log/nginx/');
$I->dontSeeFileFound('hhvm-php.error.log', '/var/log/nginx/');
$I->dontSeeFileFound('cache.hhvm-hhvm.access.log', '/var/log/nginx/');
$I->dontSeeFileFound('cache.hhvm-hhvm.apachestyle.access.log', '/var/log/nginx/');
$I->dontSeeFileFound('cache.hhvm-hhvm.error.log', '/var/log/nginx/');
$I->dontSeeFileFound('cache.hhvm-php.access.log', '/var/log/nginx/');
$I->dontSeeFileFound('cache.hhvm-php.apachestyle.access.log', '/var/log/nginx/');
$I->dontSeeFileFound('cache.hhvm-php.error.log', '/var/log/nginx/');

$I->wantTo('Check for existance of nginx config files');
$I->seeFileFound('www-hhvm.conf', '/etc/nginx/');

$I->wantTo('Check for the absence of legacy nginx config files');
$I->dontSeeFileFound('hhvm-hhvm.conf', '/etc/nginx/');
$I->dontSeeFileFound('hhvm-php.conf', '/etc/nginx/');

$I->wantTo('Check for the absence of legacy PimpMyLogs config files');
$I->dontSeeFileFound('hhvm-hhvm.json', '/nas/wp/www/sites/admin/logs/config.user.d/');
$I->dontSeeFileFound('hhvm-php.json', '/nas/wp/www/sites/admin/logs/config.user.d/');

$I->wantTo('Check for existance of PimpMyLogs config files');
$I->seeFileFound('hhvm.json', '/nas/wp/www/sites/admin/logs/config.user.d/');
