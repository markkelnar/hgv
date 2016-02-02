# Mercury Vagrant Changelog

## 1.5.1 (2016-02-02)

 * 2016-02-01 Mark Kelnar: BUG FIX Remove errant unused variable leftover after a refactor

## 1.5 (2015-09-30)

 * 2015-09-28 Mark Kelnar: Only the essentials for the www pool file
 * 2015-09-28 Mark Kelnar: Move the php-selector plugin to a must-use
 * 2015-09-28 Mark Kelnar: Fix typo
 * 2015-09-28 Mark Kelnar: Create php7/conf.d directory if not exist
 * 2015-09-28 Mark Kelnar: Add php.ini file and file_upload_size
 * 2015-09-28 Mark Kelnar: Add documentation on provisioning/roles/nginx/templates/nas/wp/www/sites/dashboard/ass php-selector
 * 2015-09-28 Mark Kelnar: Add documentation on php-selector
 * 2015-09-26 Mark Kelnar: Use object-cache file usiong Memcached() in place of previous object-cache using Memcache().
 * 2015-09-26 Mark Kelnar: Add tasks/script to compile php7 memcached.so and object-cache file to talk Memcached()
 * 2015-09-25 Mark Kelnar: Modify the text on the error page
 * 2015-09-25 Mark Kelnar: Fix cookie set path used by error page
 * 2015-09-24 Mark Kelnar: Moved the error-page to inside the plugin
 * 2015-09-24 John Blackbourn: Update the list of default plugins.
 * 2015-09-23 Eric Mann: Minimal HHVM Debug Docs
 * 2015-09-23 Eric Mann: Force the Mailhog init script to use LF line endings on checkout
 * 2015-09-22 Mark Kelnar: Move error page into selector plugin
 * 2015-09-22 Mark Kelnar: Fix bug. Reload on php select
 * 2015-09-22 Mark Kelnar: Add Nginx 500 error handler when using backend cookie
 * 2015-09-21 Mark Kelnar: Tweak the object cache file so it doesnt run or crash under php7
 * 2015-09-21 Mark Kelnar: Should still be Memcache()
 * 2015-09-21 Mark Kelnar: Refactor, add README and rename plugin
 * 2015-09-21 Mark Kelnar: Add rel attribute to pull down value and reload on click
 * 2015-09-21 Eric Mann: Make commands executable
 * 2015-09-21 Eric Mann: Fix checkmark and x chars because Windows is dumb.
 * 2015-09-21 Eric Mann: Clean up the flags a bit and print out incrementally rather than all at once.
 * 2015-09-18 Eric Mann: Use a better abstract method
 * 2015-09-18 Eric Mann: Remove dead code
 * 2015-09-18 Eric Mann: Begin adding preflight script for Vagrant, VirtualBox, and Node.
 * 2015-09-18 Eric Mann: Add a test for Vagrant Ghost
 * 2015-09-18 Eric Mann: Add Git version checking
 * 2015-09-18 Eric Mann: Abstract the VirtualBox check
 * 2015-09-18 Eric Mann: Abstract the Git check as well
 * 2015-09-16 Mark Kelnar: Remove accidently domain from testing
 * 2015-09-16 Mark Kelnar: Enqueue scripts for dashboard and page view
 * 2015-09-15 Mark Kelnar: php7 handler to use stop/start
 * 2015-09-15 Mark Kelnar: Set permissions of check script
 * 2015-09-15 Mark Kelnar: Set default_php for all to hhvm
 * 2015-09-15 Mark Kelnar: Fix some php7 handler restart
 * 2015-09-15 Mark Kelnar: Adjust some php7 paths
 * 2015-09-15 Mark Kelnar: Add php7 tests
 * 2015-09-15 Mark Kelnar: Add php7 config files
 * 2015-09-15 Mark Kelnar: Add php7 backend upstream
 * 2015-09-15 Mark Kelnar: Add checkconf script
 * 2015-09-15 Mark Kelnar: Add backend selector plugin
 * 2015-08-26 John Blackbourn: Add some more developer plugins to the provisioning.

## 1.4 (2015-09-17)

 * 2015-09-15 Stephen Lin: Add Contributor
 * 2015-08-31 Mark Kelnar: Remove references to hgv.dev in favor of hgv.test
 * 2015-08-31 Mark Kelnar: Add documentation about the cookie
 * 2015-08-27 Mark Kelnar: Add support for PHP backend to be specified by cookie
 * 2015-08-24 Mark Kelnar: Add multisite domain and directory provisioning in ansible
 * 2015-08-24 Eric Mann: Use a static tag instead of master
 * 2015-08-24 Eric Mann: Update script location to `/hgv_data/config/sites` for consistency with #216
 * 2015-08-24 Eric Mann: Update docs
 * 2015-08-24 Eric Mann: Update Vagrantfile
 * 2015-08-24 Eric Mann: Update GETTINGSTARTED docs
 * 2015-08-24 Eric Mann: Add VMWare Support
 * 2015-08-23 Eric Mann: Use `/hgv_data/config/sites`
 * 2015-08-23 Eric Mann: Update usage to return an object so we can bundle multiple scripts.
 * 2015-08-23 Eric Mann: Make scripts executable
 * 2015-08-21 Mark Kelnar: Check for deprecated yml config file and print
 * 2015-08-21 Eric Mann: Wire up the Git mechanisms for pushing within Vagrant
 * 2015-08-21 Eric Mann: Make sure scripts are executable
 * 2015-08-21 Eric Mann: Add an error message
 * 2015-08-21 Eric Mann: Add Git wrapper for executing commands
 * 2015-08-19 Mark Kelnar: Reference new location for user custom config files
 * 2015-08-19 Mark Kelnar: Document the custom-plugins provisioning list
 * 2015-08-19 Mark Kelnar: Add test for file upload size
 * 2015-08-18 Mark Kelnar: Use Nginx port variable in a few places. Remove unused legacy file
 * 2015-08-18 Mark Kelnar: Map domains to host variable not http_host
 * 2015-08-18 Mark Kelnar: Extract varnish vcl template to a variable. Add support for an imported ansible.yml file for variable overrides
 * 2015-08-18 Mark Kelnar: Add support for extra vars overrides
 * 2015-08-18 Mark Kelnar: Add documentation to dashboard
 * 2015-08-18 Mark Kelnar: Add documentation about the multisite config flag
 * 2015-08-18 Mark Kelnar: Add a varnish test
 * 2015-08-17 Mark Kelnar: Add multisite WP tests
 * 2015-08-15 Eric Mann: Replace sync method with async method
 * 2015-08-15 Eric Mann: Properly load config files using promises to protect async operations
 * 2015-08-15 Eric Mann: Install the phpinfo and hhvminfo files
 * 2015-08-15 Eric Mann: Don't Overwrite Constant
 * 2015-08-15 Eric Mann: Begin wiring scripts for environment selection and deploy pushing.
 * 2015-08-15 Eric Mann: Add template files
 * 2015-08-15 Eric Mann: Add Info files to Admin Area
 * 2015-08-13 Eric Mann: Add space below the header
 * 2015-08-12 Mark Kelnar: Add Wp multisite nginx configs and conditional include.
 * 2015-08-08 Eric Mann: Update docs explaining Vagrant version switching
 * 2015-08-08 Eric Mann: Update Config Locations and Usage
 * 2015-08-08 Eric Mann: Remove .mercuryrc from gitignore
 * 2015-08-08 Eric Mann: Move scripts around to make things a bit more consistent
 * 2015-08-04 Eric Mann: Remove bulky node modules and move package.json to the root
 * 2015-08-04 Eric Mann: Ignore node_modules
 * 2015-08-04 Eric Mann: Enable Customfile Overrides
 * 2015-08-04 Eric Mann: Document Node dependency
 * 2015-07-24 Eric Mann: Add VM name
 * 2015-07-23 Mark Kelnar: Use join to build domain names
 * 2015-07-23 Mark Kelnar: Fix codeception tests about nginx log changes
 * 2015-07-23 Jeremy Pry: Create separate task for VCS plugins
 * 2015-07-21 Eric Mann: Make sure bundled keys aren't CRLF'ed upon checkout.
 * 2015-07-20 Jeremy Pry: Add Amazon S3 plugin to the list
 * 2015-07-16 Eric Mann: Wire in prompts
 * 2015-07-16 Eric Mann: Move the node dependency to the right location
 * 2015-07-16 Eric Mann: Make sure scripts are executable as-is.
 * 2015-07-16 Eric Mann: Make sure our arrays are properly de-duped
 * 2015-07-16 Eric Mann: Add prompts
 * 2015-07-15 Mark Kelnar: Update details of how top invoke these tests
 * 2015-07-15 Mark Kelnar: Add initial codecept tests for log file checks
 * 2015-07-14 Mark Kelnar: Remove files of the old format in favor of the new
 * 2015-07-14 Mark Kelnar: Add cache config files that shouldn't exist anymore
 * 2015-07-14 Eric Mann: Update start script to auto-detect rc file
 * 2015-07-14 Eric Mann: Ignore the rc file
 * 2015-07-14 Eric Mann: Begin pulling the script together with bundled dependencies
 * 2015-07-14 Eric Mann: Add YAML parsing and writing
 * 2015-07-14 Doug Stewart: Allow for custom plugin listings to be added to individual HGV instances.
 * 2015-07-09 Mark Kelnar: Enable and specify file upload size in hhvm
 * 2015-06-29 Mark Kelnar: Refactor to use nginx maps to associate domains to backend
 * 2015-06-29 Mark Kelnar: Change PimpMyLog for new nginx log name
 * 2015-06-29 Mark Kelnar: Accidental drop of items from PML
 * 2015-06-25 Mark Kelnar: Describe the workflow, develop branch and hotfixes
 * 2015-06-25 Mark Kelnar: Clarify the testing expectations
 * 2015-06-25 Mark Kelnar: Add sudo and some documentation to the scripts
 * 2015-06-24 Jon Brown: Update README.md
 * 2015-06-19 Mark Kelnar: Move comment to group_vars file
 * 2015-06-18 Mark Kelnar: Increase file upload size settings for nginx and php
 * 2015-06-01 Eric Mann: Ensure we're checking versions
 * 2015-06-01 Eric Mann: Enable Hyper-V as a Provider
 * 2015-05-28 Doug Stewart: First pass at a basic Mac/Linux script.
 * 2015-05-27 Doug Stewart: Want to encourage use for WP and non-WP.
 * 2015-05-27 Doug Stewart: Break WP into separate provisioning script.
 * 2015-05-27 Doug Stewart: Abstract config file locations into variables for easier re-use/alteration later.
 * 2015-05-22 miya0001: ran severspec-init and update .gitignore
 * 2015-05-22 miya0001: add serverspec tests

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
