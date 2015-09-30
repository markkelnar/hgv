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
 * config/ -- User owned configuration files
 *   sites/ -- User owned WordPress configurations, foo.yml, used for provisioning sites and domains.
 *   provisioning/ansible.yml -- User owned extra variables imported during vagrant up to the ansible provisioning playbook.
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
HGV automatically creates four sites and adds host file entries for them (*if you installed the `vagrant-ghost` plugin, that is*):

* [hgv.test](http://hgv.test) -- General documentation and links for all of the tools
* [hhvm.hgv.test](http://hhvm.hgv.test) -- A new WordPress installation running on HHVM
* [php.hgv.test](http://php.hgv.test) -- A new WordPress installation running on PHP-FPM (PHP 5.5)
* [admin.hgv.test](http://admin.hgv.test) -- Useful administrative tools (phpMyAdmin, etc.)

If you did *not* install the `vagrant-ghost` plugin, you will need to manually [add](http://www.howtogeek.com/howto/27350/beginner-geek-how-to-edit-your-hosts-file/) the following host entries to your host operating system's host files:

```
192.168.150.20 hgv.test
192.168.150.20 admin.hgv.test
192.168.150.20 hhvm.hgv.test
192.168.150.20 php.hgv.test
192.168.150.20 cache.hhvm.hgv.test
192.168.150.20 cache.php.hgv.test
```

## WordPress Installations ##

### Default Installs ###
There is one default WordPress installation provided and accessible at two domains. The provisioning details for this WordPress can be found in the file `provisioning/default-install.yml`.

#### hhvm.hgv.test ####
[hhvm.hgv.test](http://hhvm.hgv.test) is a basic WordPress install running the latest stable version of WordPress on top of an Nginx + HHVM + Percona DB stack.

#### php.hgv.test ####
[php.hgv.test](http://php.hgv.test) is a basic WordPress install running the latest stable version of WordPress on a fairly standard [LEMP stack](https://lemp.io/) consisting of Nginx, PHP-FPM and Percona DB.

### Database Access ###
Both have an admin user `wordpress` with a password `wordpress` (so secure!) already created.

### Accessing the sites on-disk (docroot) ###
The default WordPress installations are accessible directly by going to `[HGV directory]/hgv_data/sites/hhvm` in the Finder (Mac)/Explorer (Windows)/filesystem navigator of choice (Linux, Free/Open/NetBSD, etc.).  When logged into the Vagrant ssh terminal, they are located at `/nas/wp/www/sites/hhvm`.

### Developer Tools ###
The following WordPress tools and plugins are installed on each WordPress site (but are **not** enabled) by default:

* [Query Monitor](https://wordpress.org/plugins/query-monitor/)
* [Debug Objects](https://wordpress.org/plugins/debug-objects/)
* [Debug Bar](https://wordpress.org/plugins/debug-bar/)
* [User Switching](https://wordpress.org/plugins/user-switching/)
* [Rewrite Rules Inspector](https://wordpress.org/plugins/rewrite-rules-inspector/)
* [Log Deprecated Notices](https://wordpress.org/plugins/log-deprecated-notices/)

### Installing plugins and themes ###
Installing new plugins and themes is as simple as putting themes in `[HGV directory]/hgv_data/sites/hhvm/wp-content/[plugins|themes]`


## Add My Own WordPress ##

### The Provision File ###
Let HGV provision your WordPress for you.

1. Copy provisioning/default-install.yml to hgv_data/config/sites/foo.yml.
2. Change the `enviro` variable to the docroot of where your WordPress lives under `[HGV directory]/hgv_data/sites/`, ie 'foo'. If the directory does not exist when provisioning is executed, it will be created and the latest stable version or WordPress installed.
3. Edit the domain lists to be the domain(s) you want setup for the WordPress residing in the Vagrant. Domains listed under `hhvm_domains` will be served by HHVM.  Those listed under `php_domains` will be served by the PHP-FPM service. See the section in this documentation on [PHP Selector](/#mercury-vagrant-hgv-add-my-own-wordpress-php-selector) for more.

If you did not install the vagrant-ghost plugin, you will need to manually add the domains to your host operating system’s host files. See the example [above](/#mercury-vagrant-hgv-what-you-get-sites).

### Example ###

hgv_data/config/sites/foo.yml

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

### PHP Selector ###
You have two ways to select which backend PHP processor builds your site. One involves the YAML configuration file.  The other is controlled by a WordPress plugin.

By domain in YAML

Determining the backend PHP processor is handled by the YAML configuration file.  Put any domains you wish to be built by HHVM under `hhvm_domains`.  Put any domains you wish to be built by PHP 5 under `php_domains`.

By clicking

Point and click to switch between the backend PHP processors. The `php-selector` plugin is enabled as a 'must-use' plugin for the WordPress and takes the details out of configuring domains in the YAML file.

<img src="/assets/images/screenshot-1.png" alt="PHP Selector pull down screenshot" height="150px" />

Atleast one domain must be configured for the WordPress under the `hhvm_domains` list of domains. The `php_domains` list of domains can be left blank.

### Error Page ###
If building of the page results in a 500 error and it appears as though you're using the php-selector plugin, an error page will appear.  It assumes that you are switching between PHP versions to test your code and as a result, have code that has broken the page build.  The error page allows you to switch to another PHP backend where your page might be building without error.

### Provision ###
After editing or adding a new configuration, for the changes to take effect, you must run `vagrant provision` on an already provisioned environment.

### Multisite ###

If your WordPress is a multisite, it requires certain configurations in the environment to know this is what you want.  So, in your YAML config file, add the *multisite* option with value 'domain' for subdomain or 'directory' for subdirectory.  Then re-provision the vagrant.

Adding, removing or changing this option does not convert an existing WordPress to or from being a multisite.

```
wp:
  ...
  multisite: domain
```

or

```
wp:
  ...
  multisite: directory
```

### Extra Plugins Installed ###

Have plugins that you want installed on disk with your WordPress?  Want that install done automatically when HGV is provisioned? If so, add the *custom_plugins* option to your custom YAML file along with the name of the plugin as it exists in the WordPress repository.  It's that simple.

```
wp:
  ...
  custom_plugins:
    - akismet
    - wordpress-seo
```

## Admin Tools ##
HGV contains several useful tools for gathering system state and for administering individual aspects of the system.

### Database ###
phpMyAdmin is available at [admin.hgv.test/phpmyadmin/](http://admin.hgv.test/phpmyadmin/). The username is `root` and the  password is blank.

### Object Cache/Memcached ###
phpMemcachedAdmin is available at [admin.hgv.test/phpmemcachedadmin/](http://admin.hgv.test/phpmemcachedadmin/). You may use this tool to check on the status of the WordPress [object cache](http://codex.wordpress.org/Class_Reference/WP_Object_Cache).

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

* `[enviro].access.log`
* `[enviro].apachestyle.access.log`
* `[enviro].error.log`

The first two logs track web requests to the sites, while the third log tracks errors reported, both by Nginx and by "upstream" PHP and HHVM processes.

HHVM logs are in `/var/log/hhvm`. PHP-FPM writes all of its logging information into `/var/log/php5-fpm.log`.

Sometimes, keeping tabs on a log file while hitting a site to view log messages in real-time can be helpful. To do so, run `sudo tail -f [log file]` from your SSH session. For example, `sudo tail -f /var/log/nginx/[enviro].error.log` would give you an always-updating view of the error log file for the site.

### Database access ###
You may easily use the phpMyAdmin installation at [admin.hgv.test/phpmyadmin/](http://admin.hgv.test/phpmyadmin/) (as listed above) in order to view and interact with the underlying database. However, if you are used to using a third-party GUI, such as
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
HGV includes an advanced PHP/HHVM profiling tool, [http://php.net/xhprof](http://php.net/xhprof) and a GUI for viewing results. You can view results for your HGV instance at [xhprof.hgv.test](http://xhprof.hgv.test).  

Initially, there will be no profiling data -- you'll need to enable profiling for the various HGV sites. You can enable profiling by passing `_profile=1` to any PHP request on the host. To get started, visit:

* [http://php.hgv.test/?_profile=1](http://php.hgv.test/?_profile=1)
* [http://hhvm.hgv.test/?_profile=1](http://hhvm.hgv.test/?_profile=1)

Passing the `_profile=1` argument to the sites causes XHProf to set a cookie. While this cookie is active, XHProf will attempt to profile all of your page views. Visit a few URLs on your PHP and HHVM sites, then visit [xhprof.hgv.test](http://xhprof.hgv.test) again. You should see profiling results displayed for your interactions with the sites.

When you want to disable profiling, simply append `_profile=0` to any request, or visit these links:

* [http://php.hgv.test/?_profile=0](http://php.hgv.test/?_profile=0)
* [http://hhvm.hgv.test/?_profile=0](http://hhvm.hgv.test/?_profile=0)

Visiting those links should delete the cookie and disable XHProf.

### HHVM ###

HHVM debugging information can be found in Facebooks [official documentation](https://github.com/facebook/hhvm/blob/master/hphp/doc/debugger.start).


## Overriding environment defaults ##

### Maintain your own overrides file ###

1) Add YAML formatted file in hgv_data/config/provisioning/ansible.yml containing the ansible variable(s) you wish to override.

2) After editing or adding a new configuration, for the changes to take effect, you must run `vagrant provision`.

### Example ###

This is an example of changing the max file upload size allowed by Nginx, HHVM, PHP-FPM and the WordPress.

```
---
file_upload_max_size: 50
```

### Cookie to toggle the backend ###

Don't want to configure both domains for each WordPress' backend processor?  But still want to be able to flip between HHVM and PHP? Have a multisite WordPress which makes it difficult to add domains for each backend processor?

Use a browser cookie to specify the backend. 

The name of the cookie is 'backend'. It accepts values `hhvm` or `php`. If the cookie does not exist or contains something other than the accepted values, it will be ignored and the mapped domain from the [provision file](/#mercury-vagrant-hgv-add-my-own-wordpress-the-provision-file) will be used.

This is specific to the HGV development environment.  This cookie feature is not available for Mercury production.

**TODO:** Add a drop in plugin that allows the user to toggle the cookie via the HGV dashbaord or in WP Admin for a site.

## FAQs ##

### General FAQs ###
Can be found on the [wiki](https://github.com/wpengine/hgv/wiki).
