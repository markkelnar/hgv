<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('Check for existance of log files');
$I->seeFileFound('hhvm-hhvm.access.log', '/var/log/nginx/');
$I->seeFileFound('hhvm-hhvm.apachestyle.access.log', '/var/log/nginx/');
$I->seeFileFound('hhvm-hhvm.error.log', '/var/log/nginx/');
$I->seeFileFound('cache.hhvm-hhvm.access.log', '/var/log/nginx/');
$I->seeFileFound('cache.hhvm-hhvm.apachestyle.access.log', '/var/log/nginx/');
$I->seeFileFound('cache.hhvm-hhvm.error.log', '/var/log/nginx/');
$I->seeFileFound('hhvm-php.access.log', '/var/log/nginx/');
$I->seeFileFound('hhvm-php.apachestyle.access.log', '/var/log/nginx/');
$I->seeFileFound('hhvm-php.error.log', '/var/log/nginx/');
$I->seeFileFound('cache.hhvm-php.access.log', '/var/log/nginx/');
$I->seeFileFound('cache.hhvm-php.apachestyle.access.log', '/var/log/nginx/');
$I->seeFileFound('cache.hhvm-php.error.log', '/var/log/nginx/');

$I->wantTo('Check for existance of nginx config files');
$I->seeFileFound('hhvm-hhvm.conf', '/etc/nginx/');
$I->seeFileFound('hhvm-php.conf', '/etc/nginx/');

$I->wantTo('Check for existance of PimpMyLogs config files');
$I->seeFileFound('hhvm-hhvm.json', '/nas/wp/www/sites/admin/logs/config.user.d/');
$I->seeFileFound('hhvm-php.json', '/nas/wp/www/sites/admin/logs/config.user.d/');
