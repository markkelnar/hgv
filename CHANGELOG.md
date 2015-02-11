# Mercury Vagrant Changelog

## 1.1 (2015-02-11)

 * 2015-02-10 Mark Kelnar: This =404 doesnt act as I would expect
 * 2015-02-10 Mark Kelnar: Pass more params to fastcgi when come from varnish
 * 2015-02-10 Mark Kelnar: Fix nginx log filenames since name change
 * 2015-02-09 Mark Kelnar: Idempotent wpcli execution perms
 * 2015-02-09 Mark Kelnar: Tries to set group/user to vagrant each rsync
 * 2015-02-09 Mark Kelnar: Tries to set group/user to vagrant each rsync
 * 2015-02-05 Mark Kelnar: Add new domain that shares the hhvm WP install but processed by FPM
 * 2015-02-05 Mark Kelnar: Add note under 1.0
 * 2015-02-04 Mark Kelnar: Update change log for the V1.1 release.
 * 2015-02-04 Mark Kelnar: Back out the new WP endpoint. Not ready for it just yet
 * 2015-02-02 Mark Kelnar: Split the line into two lines and priorities
 * 2015-02-02 Mark Kelnar: Specify user/group perms for WP config files
 * 2015-02-02 Mark Kelnar: No symlinks for WP config anymore
 * 2015-02-02 Mark Kelnar: Fix wordpress destination
 * 2015-02-02 Mark Kelnar: Remove sites-* directories from nginxs visibility
 * 2015-02-02 Mark Kelnar: Move dashboard files to conf.d
 * 2015-02-02 Mark Kelnar: Move xhprof files to conf.d
 * 2015-02-02 Mark Kelnar: Move admin files to conf.d
 * 2015-02-02 Mark Kelnar: The original hhvm and php endpoints using new listener role
 * 2015-02-02 Mark Kelnar: Provision new endpoints to serve from single new WP install
 * 2015-02-02 Mark Kelnar: Fix object cache key based on domain
 * 2015-01-30 Mark Kelnar: Set user/group/perms for yaml.ini. Idempodent tweak for php5enmod
 * 2015-01-30 Mark Kelnar: That condition fails when wp-cli doesnt pass a url
 * 2015-01-30 Mark Kelnar: Separate wordpress nginx tasks into listener role
 * 2015-01-28 Tim Dalbey: Update README.md
 * 2015-01-25 Doug Stewart: Duplication -- whoops!
 * 2015-01-21 Mark Kelnar: Use HTTP_HOST for cache siteurl and home defines
 * 2015-01-21 Mark Kelnar: Visual line breaks around wordpress role args
 * 2015-01-21 Mark Kelnar: Pass in domain variable to wordpress role
 * 2015-01-21 Doug Stewart: Strike that, reverse it.
 * 2015-01-20 John Whitley: Turn off nginx sendfile due to VirtualBox bug
 * 2015-01-20 John Whitley: Update README for current shared directory name
 * 2015-01-20 Mark Kelnar: Add ssh forward agent option for the vagrant
 * 2015-01-19 Doug Stewart: Set up basic PHP YAML support
 * 2015-01-16 Mark Kelnar: Make sure phpunit apt version is gone
 * 2015-01-16 Mark Kelnar: Get phpunit from the phar download instead of apt
 * 2015-01-16 Simon Prosser: Prevent PHP warning because $this->debug is unset.
 * 2015-01-14 Mark Kelnar: Remove a dash

## 1.0 (2015-01-13)

 * 2015-01-13 Mark Kelnar: Initial version

## 0.1

 * Initial version
