# Mercury Vagrant (HGV) #

This project is meant to allow people in the WordPress community to run a single Vagrant for developing, debugging, and deploying HHVM based code. We have also added standard PHP to test against so that this project is useful for more standard development as well.

The project is also intended as a tool for allowing WP Engine users to test their code prior to actual deployment on WP Engine "Mercury" infrastructure. This is not intended as an exact replica of WP Engine's infrastructure, but is instead a "simulator" of the conditions and software stack on WPE's Mercury platform, allowing you to develop and test your code with an end goal of stability and compatibility with Mercury.

Mercury differs from standard WordPress hosting in several ways, chief among which is the use of HHVM to serve all PHP code. To quote [HHVM's Website](http://hhvm.com):

> HHVM is an open-source virtual machine designed for executing programs written in Hack and PHP. HHVM uses a just-in-time (JIT) compilation approach to achieve superior performance while maintaining the development flexibility that PHP provides.

We have some great [getting started videos and guides here](http://wpengine.com/mercury/how-to-start/) if you want a more guided experience.

## About ##

Mercury Vagrant is a WP Engine creation in partnership with community members.

**Version:** 1.5

**Latest Stable:** 1.5

**Web:** [http://wpengine.com/mercury](http://wpengine.com/mercury)

**Project Lead:** Jason Cohen

**Contributors:** Mark Kelnar, Doug Stewart, Zach Brown, RC Johnson, Jason Cohen, Kailey Lampert, Cameron Benedict, Grant Landram, Ryan Oeltjenbruns, Lowell Vaughn, Rachel Baker, Eric Mann, Stephen Lin

**Thanks:** To the [VVV](http://varyingvagrantvagrants.org/) team and others who have worked on the open source we've included.

## Prerequisites ##
In order to use HGV effectively, you'll need to have a few tools installed on your computer. You should:

1. Install [Git](http://git-scm.org).
 * Windows users: Be sure to add the Git executables to your path (See, e.g. [this guide](https://eamann.com/tech/vagrant-windows/), under "Prerequisites")
2. Install virtual machine software ([VMware](http://vmware.com) or [VirtualBox](http://virtualbox.org) are recommended).
3. Install [Vagrant](http://vagrantup.com)
4. Install [Node](https://nodejs.org/)
5. **Optional, but highly recommended:** Install the [Vagrant Ghost plugin](https://github.com/10up/vagrant-ghost)
 * Short version: `vagrant plugin install vagrant-ghost`
6. **Suggestion:** Development workstation/laptop should have at least 8GB of RAM. hgv needs to allocate 1GB of RAM in order to run. (Users with <=4GB of RAM [e.g. base-model MacBook Airs] have seen overall system slowness while running this Vagrant box and much of anything else.)
7. Windows users should be certain that their BIOS' virtualization settings are enabled. (Intel owners should enable VT-x while AMD owners should enable AMD-v. See [here](http://www.sysprobs.com/disable-enable-virtualization-technology-bios) for a better explanation.)
8. **Recommendation:** This Vagrant box uses a 64 bit operating system (because HHVM requires a 64 bit OS), so we highly recommend that it only be run on 64 bit machines running 64 bit operating systems. (Most, if not all desktops and laptops sold in the last few years are running on 64 bit processors. Some may not be running 64 bit operating systems, however. Please check your system's documentation.) 

## Installation ##
1. `git clone --recursive https://github.com/wpengine/hgv.git` to clone the latest version of the tool.
2. Change into the directory `hgv`.
3. Run `npm install` to install build and deploy script dependencies.
4. Run `vagrant up`.

## How to update when a new version is released ##

Two options to decide, do you delete your existing vagrant and any WP database work or b) do you run the setup scripts to update your existing vagrant environment?

A) To delete your existing HGV vagrant work and re-create from scratch

1. Change into the directory `hgv`.
2. Run `vagrant destroy`.
3. Run `vagrant up`.

B) To run the script that will update your existing vagrant

1. Change into the directory `hgv`.
2. Run `vagrant reload`.
3. Run `vagrant provision`.

## What you get ##
### Software stack ###
HGV uses a mixture of Vagrant's [shell provisioner](https://docs.vagrantup.com/v2/provisioning/shell.html) to kick things off and then uses a tool called [Ansible](http://docs.ansible.com) to complete the configuration of the system.

Once Vagrant is done provisioning the VM, you will have a box running Ubuntu 14.04 (aka Trusty Tahr) containing:

* [Percona DB](http://percona.com)
* [PHP-FPM](http://php-fpm.org)
* [HHVM](http://hhvm.com)
* [Nginx](http://nginx.com)
* [Varnish](http://varnish-cache.org)
* [Memcached](http://memcached.org)

## Next Steps ##
Once the VM is done provisioning, direct your browser to [http://hgv.test](http://hgv.test) You will receive fuller instructions on the use of this Vagrant environment there.

### Once Installed These Local URLs / SITES Contain Great Documentation ###
No really, make sure you go to these to check them out as you work with HGV. HGV automatically creates four sites and adds host file entries for them (if you installed the `vagrant-ghost` plugin, that is):

* [hgv.test](http://hgv.test) -- General documentation and links for all of the tools
* [hhvm.hgv.test](http://hhvm.hgv.test) -- A new WordPress installation running on HHVM
* [php.hgv.test](http://php.hgv.test) -- A new WordPress installation running on PHP-FPM (PHP 5.5)
* [admin.hgv.test](http://admin.hgv.test) -- Useful administrative tools (phpMyAdmin, etc.)

If you did not install the `vagrant-ghost` plugin, you will need to manually [add](http://www.howtogeek.com/howto/27350/beginner-geek-how-to-edit-your-hosts-file/) the following host entries to your host operating system's host files:

```conf
192.168.150.20 hgv.test
192.168.150.20 admin.hgv.test
192.168.150.20 hhvm.hgv.test
192.168.150.20 php.hgv.test
192.168.150.20 cache.hhvm.hgv.test
192.168.150.20 cache.php.hgv.test
192.168.150.20 xhprof.hgv.test
```

## Using URLs to View Different Stacks Running Your Code ##

There are two default WordPress installations provided. Both have an admin user *wordpress* with a password *wordpress* (so secure!) already created.

### php.hgv.test ###

[php.hgv.test](http://php.hgv.test) is a basic WordPress install running the latest stable version of WordPress on a fairly standard [LEMP](https://lemp.io/) stack consisting of Nginx, PHP-FPM, and Percona DB.

### hhvm.hgv.test ###

[hhvm.hgv.test](http://hhvm.hgv.test) is a basic WordPress install running the latest stable version of WordPress on top of an Nginx + HHVM + Percona DB stack.

### Varnish Testing ###

The following URLs will let you view a specific page with caching turned on to test for dynamic content performance.

* [cache.php.hgv.test](http://cache.php.hgv.test)
* [cache.hhvm.hgv.test](http://cache.hhvm.hgv.test)

## Development and debugging ##
### WordPress developer tools ###

The following WordPress tools and plugins are installed on each WP site (but are not enabled) by default. We highly recommend you try them out if you have not before:

* [Query Monitor](https://wordpress.org/plugins/query-monitor/)
* [Debug Objects](https://wordpress.org/plugins/debug-objects/)
* [Debug Bar](https://wordpress.org/plugins/debug-bar/)
* [User Switching](https://wordpress.org/plugins/user-switching/)
* [Rewrite Rules Inspector](https://wordpress.org/plugins/rewrite-rules-inspector/)
* [Log Deprecated Notices](https://wordpress.org/plugins/log-deprecated-notices/)

### Accessing the sites on-disk ###
HGV utilizes Vagrant's [synced folders](http://docs.vagrantup.com/v2/synced-folders/index.html) to create a folder, `hgv_data`, that is accessible from both the HGV virtual machine and your operating system. This directory will be available for use after the first time the virtual machine is started using the `vagrant up` command. You can access the WP installations directly by going to `[HGV directory]/hgv_data/sites` in the Finder (Mac)/Explorer (Windows)/filesystem navigator of choice (Linux, Free/Open/NetBSD, etc.)

### Installing plugins and themes ###

Installing new plugins and themes is as simple as putting themes in `[HGV directory]/hgv_data/sites/hhvm/wp-content/[plugins|themes]`

### Command line (CLI) access ###

To connect to the Vagrant instance, type `vagrant ssh` from inside of the HGV directory. This will place you in the CLI on the VM.

### Viewing log files ###

Once you are connected to the HGV virtual machine, system and web server logs can be viewed in
`/var/log` . You may view the contents of the system log by typing `sudo less /var/log/syslog`.

Web server logs are stored in `/var/log/nginx`, with separate log files for every site. Each site has several log files associated with it:

* `[site].hgv.dev.access.log`
* `[site].hgv.dev.apachestyle.access.log`
* `[site].hgv.dev.error.log`

The first two logs track web requests to the sites, while the third log tracks errors reported, both by Nginx and by "upstream" PHP and HHVM processes.

HHVM logs are in `/var/log/hhvm` . PHP-FPM writes all of its logging information into
`/var/log/php5-fpm.log` .

Sometimes, keeping tabs on a log file while hitting a site to view log messages in real-time can be helpful. To do so, run `sudo tail -f [log file]` from your SSH session. For example, `sudo tail -f /var/log/nginx/php.hgv.dev.error.log` would give you an alwaysupdating view of the error log file for the PHP-FPM-based site.

### Database access ###

You may easily use the phpMyAdmin installation at [admin.hgv.test/phpmyadmin/](http://admin.hgv.test/phpmyadmin/) (as listed above) in order to view and interact with the underlying database. However, if you are used to using a third-party GUI, such as [Sequel Pro](http://www.sequelpro.com/) or [MySQL Workbench](http://www.mysql.com/products/workbench/), TCP port 3306 (the MySQL/Percona port) is forwarded from the Vagrant VM to TCP port 23306 on your actual machine. You would then configure MySQL WB or Sequel Pro to connect to `localhost:23306` .

### Developer tools ###

The following useful developer tools are installed by default:

* [Git](http://git-scm.com)
* [Subversion](https://subversion.apache.org/)
* [cURL](http://curl.haxx.se)
* [Ack](http://beyondgrep.com)
* [Autojump](https://github.com/joelthelion/autojump)
* [Siege](http://www.joedog.org/siege-home/)
* [Composer](https://getcomposer.org)
* [PsySH](http://psysh.org)
* [Boris](https://github.com/d11wtq/boris)
* [Xdebug](http://xdebug.org)
* [XHProf](http://php.net/xhprof)
* [PHPUnit](https://phpunit.de)

### Xdebug ###

PHP's [Xdebug extension](http://xdebug.org) is installed by default for the site based on PHP-FPM.  See the [dashboard](http://hgv.test/) for details about the features that are enabled by default for each WordPress.

Xdebug browser extensions to toggle Xdebug on/off without having to ssh into the virtual machine:
* [Safari - Xdebug Toggler] (https://github.com/benmatselby/xdebug-toggler)
* [FireFox - Easiest Xdebug] (https://addons.mozilla.org/en-US/firefox/addon/the-easiest-xdebug/)
* [Chrome - Xdebug Helper] (https://chrome.google.com/webstore/detail/xdebug-helper/eadndfjplgieldjbigjakmdgkmoaaaoc)

### XHProf ###
HGV includes an advanced PHP/HHVM profiling tool, [http://php.net/xhprof](http://php.net/xhprof) and a GUI for viewing results. You can view results for your HGV instance at [xhprof.hgv.test](http://xhprof.hgv.test).  See the [dashboard](http://hgv.test/) for details about how easy it is to turn on profiling by adding one parameter to your page request in the browser.

### Database ###
phpMyAdmin is available at [admin.hgv.test/phpmyadmin/](http://admin.hgv.test/phpmyadmin/). The username is `root` and the password is blank.

### Object Cache/Memcached ###

phpMemcachedAdmin is available at [admin.hgv.test/phpmemcachedadmin/](http://admin.hgv.test/phpmemcachedadmin/). You may use this tool to check on the status of the WordPress object [cache](http://codex.wordpress.org/Class_Reference/WP_Object_Cache).

### Log Viewing ###
PML is available at [admin.hgv.test/logs](http://admin.hgv.test/logs). You may use this tool to quickly view the most recent web server access and error logs for the various sites automatically created by HGV.

## More Documentation/Information ##

### Documentation layout ###

README.md - This README markdown file, the technical steps of how to get up and running.  But not all the technical details or configuration options specific to the HGV environment.

[wiki](https://github.com/wpengine/hgv/wiki) - Frequently asked questions

[website](http://wpengine.com/mercury) - General introduction for the Mercury project along with video walkthroughs about how to setup HGV for the first time.

[blog](http://wpengine.com/blog) - WP Engine blogs when significant releases or updates are made to HGV.

[updates](http://wpengine.com/mercury/updates) - Another place where the WP Engine team will go into detail about releases or updates to HGV.

[dashboard](http://hgv.test) - The local HGV dashboard which is available when your vagrant is up and running. This contains all the technical details and configuration options specific to the HGV environment.

For detailed how to install guides per OS and other debugging information please see the [wiki here on github](https://github.com/wpengine/hgv/wiki).

