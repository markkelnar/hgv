# Mercury Vagrant Changelog

## 1.1

 * 2015-02-02 Mark Kelnar: No symlinks for WP config anymore
 * 2015-02-02 Mark Kelnar: Fix wordpress destination
 * 2015-02-02 Mark Kelnar: Remove sites-* directories from nginxs visibility
 * 2015-02-02 Mark Kelnar: Move dashboard files to conf.d
 * 2015-02-02 Mark Kelnar: Move xhprof files to conf.d
 * 2015-02-02 Mark Kelnar: Move admin files to conf.d
 * 2015-01-30 Mark Kelnar: Set user/group/perms for yaml.ini. Idempodent tweak for php5enmod
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

## 1.0

 * 2015-01-13 Mark Kelnar: Initial version

## 0.1
* Initial version
