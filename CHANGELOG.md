# Mercury Vagrant Changelog

## 1.3 (2015-06-18)

 * 2015-06-18 Mark Kelnar: Add .test domains to nginx configs for hgv tools
 * 2015-06-18 Mark Kelnar: Add .test domains
 * 2015-06-17 Mark Kelnar: Change shared folder reference to synced folders
 * 2015-06-17 Mark Kelnar: Add initial details about how to setup a second WP and custom domains
 * 2015-06-15 Stephen Lin: Update README.md
 * 2015-06-15 Mark Kelnar: describe where we document the pieces
 * 2015-06-15 Mark Kelnar: The dashboard contains the technical/config options
 * 2015-06-15 Mark Kelnar: Remove documentation that is now found in the wiki page
 * 2015-06-15 Mark Kelnar: Document xhprof
 * 2015-06-15 Mark Kelnar: Add pull request checkbox syntax used for pull requests
 * 2015-06-09 Eric Mann: Force Windows to use Samba for file shares
 * 2015-05-28 Doug Stewart: Explicitly mark wp-config.php as Ansible-managed.
 * 2015-05-23 Mark Kelnar: Rename default install file
 * 2015-05-23 Mark Kelnar: Put custom configs under hgv_data directory
 * 2015-05-19 Doug Stewart: * [x] @zamoose * [ ] @markkelnar
 * 2015-05-15 Mark Kelnar: Function for processing domains from yml files
 * 2015-05-15 Mark Kelnar: File glob over custom-sites*.yml in bin init script
 * 2015-05-15 Mark Kelnar: Add php_domains processing if exists in the default-sites YML
 * 2015-05-13 Mark Kelnar: Check wp-not-installed return code of the registered variable
 * 2015-05-12 Doug Stewart: Swapfile race condition fix.
 * 2015-05-12 Doug Stewart: Set up PHP_CodeSniffer and WordPress-specific code sniffs.
 * 2015-05-12 Doug Stewart: Restart FPM if the core .ini file changes too.
 * 2015-05-07 Doug Stewart: Make the file fit objective reality instead of the one that's, you know, not real.
 * 2015-05-04 Doug Stewart: Make salts a first-class file of their own.
 * 2015-04-30 Doug Stewart: Upstart-friendly version of this.
 * 2015-04-30 Doug Stewart: Keep Ansible colors for host OS for easier debugging.
 * 2015-04-29 Mark Kelnar: Use command instead of service until we find the real reason
 * 2015-04-29 Mark Kelnar: Move wp custom domains to conf.d dir. Start to add support for that directory custom files
 * 2015-04-28 Mark Kelnar: Extract default WP dev domains to a yml file. Vagrant and ansible use variables from the file
 * 2015-04-28 Mark Kelnar: Add back domain names for admin tools
 * 2015-04-17 kevcenteno: Add support for Parallels

## 1.2 (2015-04-24)

 * 2015-04-24 Doug Stewart: We were checking for the wrong condition to short-circuit WP installs.
 * 2015-04-22 Doug Stewart: Check whether a Git dir exists. Nuke if it doesn't, as we assume that means an Ansible run failure if we don't.
 * 2015-04-16 Doug Stewart: Add back stashed wp-config.php-related changes.
 * 2015-04-22 Doug Stewart: EOF newline.
 * 2015-04-22 Doug Stewart: Add stashed importer & creates changes back.
 * 2015-04-22 Doug Stewart: Stage changes from upstream master to reduce merge conflicts.
 * 2015-04-16 Doug Stewart: Make wp-config.php a run-once affair.
 * 2015-04-16 Doug Stewart: Make plugins run only once and add the wordpress-importer plugin for data imports.
 * 2015-04-16 Doug Stewart: Switch to using uri module instead of subbing out for command.
 * 2015-04-15 kevcenteno: Set nginx FastCGI response buffer size
 * 2015-04-15 Mark Kelnar: Add php5-curl for curl.so
 * 2015-04-15 kevcenteno: Allow for big (~400Mb) sql file imports
 * 2015-04-15 Doug Stewart: Adding contributor
 * 2015-04-15 Doug Stewart: Delete the actual version of pMA being grabbed, as we'll just pull the latest from Github.
 * 2015-04-15 Doug Stewart: Piecemeal bump.
 * 2015-04-14 Doug Stewart: Adjust pMA source.
 * 2015-04-14 Rachel Baker: Bump WP-CLI version to 0.18.0
 * 2015-04-13 Michael Beil: I don't think subliceasable is a word
 * 2015-02-20 Doug Stewart: Every listener needs a corresponding PML log entry in the custom dir.
 * 2015-02-20 Doug Stewart: Make sure the custom config directory exists.
 * 2015-02-20 Doug Stewart: Force admin as an upstream dependency for the listener.
 * 2015-02-20 Doug Stewart: Adding JSON template.
 * 2015-02-17 Doug Stewart: PML: Remove all configured sites in favor of the actual provisioned sites.
 * 2015-04-02 Doug Stewart: Remove outdated .ini.
 * 2015-04-02 Doug Stewart: Change the method for enabling the module.
 * 2015-04-02 Doug Stewart: Add xdebug.ini in the proper place.
 * 2015-04-02 Morgan Estes: Adjust spacing again; removes the backtick.
 * 2015-03-31 Morgan Estes: Re-escape the backtick in the ANSI logo.
 * 2015-03-31 Doug Stewart: Forward the Xdebug port for remote debugging.
 * 2015-03-31 Doug Stewart: Deploy the .ini file.
 * 2015-03-31 Doug Stewart: Provision the Xdebug ini file specifically to enable grind files and remote debugging.
 * 2015-03-31 Doug Stewart: Make sure Webgrind web files are present.
 * 2015-03-31 Doug Stewart: Set the default CRLF setting.
 * 2015-03-28 Morgan Estes: Adjust spacing on the ANSI logo.
 * 2015-03-19 Doug Stewart: Remove P3 Profiler, as HHVM doesn't support it and it appears to be causing issues with the FPM side of things once run on HHVM.
 * 2015-03-18 Doug Stewart: No longer necessary in order to stop the tty bug.
 * 2015-03-18 Doug Stewart: Cherry-picking from @jwilberding's #91 to remove the "not a tty" issue.
 * 2015-03-17 Doug Stewart: Remove spurious variable.
 * 2015-03-17 Doug Stewart: Fix for the wonky default blockquote/code syntax that was weirding people out.
 * 2015-03-17 Mark Kelnar: Add fix for hhvm using wrong mysql socket
 * 2015-03-17 TobiasBerg: Fixed wrong link to local hhvm install
 * 2015-02-25 Doug Stewart: Actually include my.cnf and bind to 0.0.0.0 instead of localhost to allow e.g. Sequel Pro to connect.
 * 2015-02-24 Doug Stewart: Set up Mailhog.
 * 2015-02-24 Doug Stewart: Enable mail-trapping for HHVM.
 * 2015-02-24 Doug Stewart: Add mail domain name.
 * 2015-02-24 Doug Stewart: Install daemonize, a neat tool to allow for daemonizing otherwise difficult processes.
 * 2015-02-24 Doug Stewart: sSMTP config file.
 * 2015-02-24 Doug Stewart: Virtualhost for Mailhog.
 * 2015-02-24 Doug Stewart: Init script for Mailhog.
 * 2015-02-24 Doug Stewart: Useful defaults for Mailhog.
 * 2015-02-20 Doug Stewart: Every listener needs a corresponding PML log entry in the custom dir.
 * 2015-02-20 Doug Stewart: Make sure the custom config directory exists.
 * 2015-02-20 Doug Stewart: Force admin as an upstream dependency for the listener.
 * 2015-02-20 Doug Stewart: Adding JSON template.
 * 2015-02-17 Doug Stewart: PML: Remove all configured sites in favor of the actual provisioned sites.
 * 2015-02-19 Mark Kelnar: Patch to install correct ansible
 * 2015-02-12 Michael Beil: update readme to latest v1.1
 * 2015-02-11 Mark Kelnar: Separate instructions into new lines
 * 2015-02-11 Mark Kelnar: Add update steps to the README
 * 2015-02-11 Mark Kelnar: Add update steps to the README
 * 2015-02-11 Mark Kelnar: Update v1.1 changelog
 * 2015-02-10 Mark Kelnar: This =404 doesnt act as I would expect
 * 2015-02-10 Mark Kelnar: Pass more params to fastcgi when come from varnish
 * 2015-02-10 Mark Kelnar: Fix nginx log filenames since name change
 * 2015-02-10 Mark Kelnar: Enable php module when not enabled already
 * 2015-02-10 Mark Kelnar: Changes in favor of idempotancy for admin tools
 * 2015-02-09 Mark Kelnar: Idempotent wpcli execution perms

## 1.1.1 (2015-02-19)

 * 2015-02-09 Mark Kelnar: Use latest ansible installation instructions

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
