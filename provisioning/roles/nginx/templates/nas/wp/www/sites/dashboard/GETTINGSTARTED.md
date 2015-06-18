# Mercury Vagrant (HGV) #
### Getting Started ###
This project is intended as a tool for allowing WP Engine users to test their code prior to actual deployment on WP Engine "Mercury" infrastructure. This is not intended as an *exact* replica of WP Engine's infrastructure, but is instead a "simulator" of the conditions and software stack on WP Engine's Mercury platform, allowing you to develop and test your code with an end goal of stability and compatibility with Mercury.

Mercury differs from standard WordPress hosting in several ways, chief among which is the use of HHVM to serve all PHP code.

To quote HHVM's [website](http://hhvm.com/):

> HHVM is an open-source virtual machine designed for executing programs written in Hack and PHP. HHVM uses a just-in-time (JIT) compilation approach to achieve superior performance while maintaining the development flexibility that PHP provides.

## What you get ##

### Directory Layout ###
The top level of the directory would contain files and directories like so:

* Vagrantfile -- Vagrant provisioning file.
* bin/ - A place for extra scripts used during provisioning of the Vagrant and WordPress'.
* hgv_data/ -- User owned data. Gets shared/mounted with the Vagrant.
 * sites/ -- Directory containing each WordPress.
 * config/ -- User owned configuration files, example, custom-sites.yml files used for provisioning sites and domains.
* provisioning/ -- The ansible provisioning code. Do not edit.
 * default-install.yml -- The configuration for the default installed sites and domains. Do not edit.

### Software stack ###
Once Vagrant is done provisioning the VM, you will have a box running [Ubuntu 14.04](http://releases.ubuntu.com/14.04/) (aka Trusty Tahr) containing

* [Percona DB](http://www.percona.com/software/percona-server)
* [PHP-FPM](http://php-fpm.org/)
* [HHVM](http://hhvm.com/)
* [Nginx](http://nginx.org/)
* [Varnish](https://www.varnish-cache.org/)
* [Memcached](http://memcached.org/)

### Sites ###
HGV automatically creates four sites and adds host file entries for them (*if you installed the `vagrant-hostsupdater` plugin, that is*):

* [hgv.dev](http://hgv.dev) -- General documentation and links for all of the tools
* [hhvm.hgv.dev](http://hhvm.hgv.dev) -- A new WordPress installation running on HHVM
* [php.hgv.dev](http://php.hgv.dev) -- A new WordPress installation running on PHP-FPM (PHP 5.5)
* [admin.hgv.dev](http://admin.hgv.dev) -- Useful administrative tools (phpMyAdmin, etc.)

If you did *not* install the `vagrant-hostsupdater` plugin, you will need to manually [add](http://www.howtogeek.com/howto/27350/beginner-geek-how-to-edit-your-hosts-file/) the following host entries to your host operating system's host files:

```
192.168.150.20 hgv.dev
192.168.150.20 admin.hgv.dev
192.168.150.20 hhvm.hgv.dev
192.168.150.20 php.hgv.dev
192.168.150.20 cache.hhvm.hgv.dev
192.168.150.20 cache.php.hgv.dev
```

## WordPress Installations ##

### Default Installs ###
There is one default WordPress installation provided and accessible at two domains. The provisioning details for this WordPress can be found in the file `provisioning/default-install.yml`.

#### hhvm.hgv.dev ####
[hhvm.hgv.dev](http://hhvm.hgv.dev) is a basic WordPress install running the latest stable version of WordPress on top of an Nginx + HHVM + Percona DB stack.

#### php.hgv.dev ####
[php.hgv.dev](http://php.hgv.dev) is a basic WordPress install running the latest stable version of WordPress on a fairly standard [LEMP stack](https://lemp.io/) consisting of Nginx, PHP-FPM and Percona DB.

### Database Access ###
Both have an admin user `wordpress` with a password `wordpress` (so secure!) already created.

### Accessing the sites on-disk (docroot) ###
The default WordPress installations are accessible directly by going to `[HGV directory]/hgv_data/sites/hhvm` in the Finder (Mac)/Explorer (Windows)/filesystem navigator of choice (Linux, Free/Open/NetBSD, etc.).  When logged into the Vagrant ssh terminal, they are located at `/nas/wp/www/sites/hhvm`.

### Developer Tools ###
The following WordPress tools and plugins are installed on each WordPress site (but are **not** enabled) by default:

* [query-monitor](https://wordpress.org/plugins/query-monitor/)
* [debug-objects](https://wordpress.org/plugins/debug-objects/)
* [debug-bar](https://wordpress.org/plugins/debug-bar/)

### Installing plugins and themes ###
Installing new plugins and themes is as simple as putting themes in `[HGV directory]/hgv_data/sites/hhvm/wp-content/[plugins|themes]`


## Add My Own WordPress ##

### The Provision File ###
Let HGV provision your WordPress for you.

1. Copy provisioning/default-install.yml to hgv_data/config/foo.yml.
2. Change the `enviro` variable to the docroot of where your WordPress lives under `[HGV directory]/hgv_data/sites/`, ie 'foo'. If the directory does not exist when provisioning is executed, it will be created and the latest stable version or WordPress installed.
3. Edit the domain lists to be the domain(s) you want setup for the WordPress residing in the Vagrant. Domains listed under `hhvm_domains` will be served by HHVM.  Those listed under `php_domains` will be served by the PHP-FPM service.

If you did not install the vagrant-hostsupdater plugin, you will need to manually add the domains to your host operating system’s host files. See the example [above](/#mercury-vagrant-hgv-what-you-get-sites).

### Example ###

hgv_data/config/foo.yml

```
---
wp:
  enviro: foo
  hhvm_domains:
    - foo.test
    - www.foo.test
  php_domains:
    - php.foo.test
```

### Provision ###
After editing or adding a new configuration, for the changes to take effect, you must run `vagrant provision` on an already provisioned environment.


## Admin Tools ##
HGV contains several useful tools for gathering system state and for administering individual aspects of the system.

### Database ###
phpMyAdmin is available at [admin.hgv.dev/phpmyadmin/](http://admin.hgv.dev/phpmyadmin/). The username is `root` and the  password is blank.

### Object Cache/Memcached ###
phpMemcachedAdmin is available at [admin.hgv.dev/phpmemcachedadmin/](http://admin.hgv.dev/phpmemcachedadmin/). You may use this tool to check on the status of the WordPress [object cache](http://codex.wordpress.org/Class_Reference/WP_Object_Cache).

## Development and debugging ##
### Command line (CLI) access ###
To connect to the Vagrant instance, type `vagrant ssh` from inside of the HGV directory. This will place you in the CLI on the VM. For example:

```bash
hostname:hgv username$ vagrant ssh
Welcome to Ubuntu 14.04 LTS (GNU/Linux 3.13.0-29-generic x86_64)

 * Documentation:  https://help.ubuntu.com/

  System information as of Mon Dec 15 17:30:03 UTC 2014

  System load:  0.01              Processes:           102
  Usage of /:   5.0% of 39.34GB   Users logged in:     1
  Memory usage: 76%               IP address for eth0: 10.0.2.15
  Swap usage:   0%                IP address for eth1: 192.168.150.20

  Graph this data and manage this system at:
    https://landscape.canonical.com/

  Get cloud support with Ubuntu Advantage Cloud Guest:
    http://www.ubuntu.com/business/services/cloud

122 packages can be updated.
59 updates are security updates.


Last login: Mon Dec 15 07:05:21 2014 from 10.0.2.2
vagrant@wpengine:~$
```

### Viewing log files ###
Once you are connected to the HGV virtual machine, system and web server logs can be viewed in `/var/log`. You may view the contents of the system log by typing `sudo less /var/log/syslog`.

Web server logs are stored in `/var/log/nginx`, with separate log files for every site. Each site has several log files associated with it:

* `[site].hgv.dev.access.log`
* `[site].hgv.dev.apachestyle.access.log`
* `[site].hgv.dev.error.log`

The first two logs track web requests to the sites, while the third log tracks errors reported, both by Nginx and by "upstream" PHP and HHVM processes.

HHVM logs are in `/var/log/hhvm`. PHP-FPM writes all of its logging information into `/var/log/php5-fpm.log`.

Sometimes, keeping tabs on a log file while hitting a site to view log messages in real-time can be helpful. To do so, run `sudo tail -f [log file]` from your SSH session. For example, `sudo tail -f /var/log/nginx/php.hgv.dev.error.log` would give you an always-updating view of the error log file for the PHP-FPM-based site.

### Database access ###
You may easily use the phpMyAdmin installation at [admin.hgv.dev/phpmyadmin/](http://admin.hgv.dev/phpmyadmin/) (as listed above) in order to view and interact with the underlying database. However, if you are used to using a third-party GUI, such as
[Sequel Pro](http://www.sequelpro.com/) or [MySQL Workbench](http://www.mysql.com/products/workbench/), TCP port 3306 (the MySQL/Percona port) is forwarded from the Vagrant VM to TCP port 23306 on your actual machine. You would then configure MySQL WB or Sequel Pro to connect to `localhost:23306`.

### Developer tools ###
The following developer tools are installed by default:

* Git
* Subversion
* Curl
* Ack
* Autojump
* Siege
* Composer
* PsySH
* Boris
* Xdebug
* XHProf
* PHPUnit

### Xdebug ###
PHP's [Xdebug extension](http://xdebug.org) is enabled by default for the site based on PHP-FPM. Additionally, the WordPress installs have the following constants defined:

```php
define('WP_DEBUG', true);
define('WP_DEBUG_DISPLAY', false);
define('SCRIPT_DEBUG', true);
define('SAVEQUERIES', true);
```

Enabling the Query Monitor WordPress plugin will allow logged-in users to view the useful debug information output by Xdebug, such as number of queries, number of objects, page render time, etc.

### XHProf ###
HGV includes an advanced PHP/HHVM profiling tool, [http://php.net/xhprof](http://php.net/xhprof) and a GUI for viewing results. You can view results for your HGV instance at [xhprof.hgv.dev](http://xhprof.hgv.dev).  

Initially, there will be no profiling data -- you'll need to enable profiling for the various HGV sites. You can enable profiling by passing `_profile=1` to any PHP request on the host. To get started, visit:

* [http://php.hgv.dev/?_profile=1](http://php.hgv.dev/?_profile=1)
* [http://hhvm.hgv.dev/?_profile=1](http://hhvm.hgv.dev/?_profile=1)

Passing the `_profile=1` argument to the sites causes XHProf to set a cookie. While this cookie is active, XHProf will attempt to profile all of your page views. Visit a few URLs on your PHP and HHVM sites, then visit [xhprof.hgv.dev](http://xhprof.hgv.dev) again. You should see profiling results displayed for your interactions with the sites.

When you want to disable profiling, simply append `_profile=0` to any request, or visit these links:

* [http://php.hgv.dev/?_profile=0](http://php.hgv.dev/?_profile=0)
* [http://hhvm.hgv.dev/?_profile=0](http://hhvm.hgv.dev/?_profile=0)

Visiting those links should delete the cookie and disable XHProf.


## FAQs ##

### General FAQs ###
Can be found on the [wiki](https://github.com/wpengine/hgv/wiki).
