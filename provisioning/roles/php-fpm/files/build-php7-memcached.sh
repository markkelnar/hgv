#!/bin/bash

/usr/local/php7/bin/phpize
./configure --with-php-config=/usr/local/php7/bin/php-config --with-libmemcached-dir=/usr/ --disable-memcached-sasl
make
make install
