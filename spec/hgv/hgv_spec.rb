require 'spec_helper'
require 'shellwords'

#
# Hosts are resolvable? or reachable?
#
hosts = %w{
  hhvm.hgv.dev
  php.hgv.dev
  fpm.hgv.dev
  cache.hhvm.hgv.dev
  cache.php.hgv.dev
  cache.fpm.hgv.dev
  admin.hgv.dev
  xhprof.hgv.dev
  mail.hgv.dev
}

hosts.each do |host|
  describe host(host) do
    it { should be_resolvable }
    it { should be_reachable.with( :port => 80, :proto => 'tcp' ) }
  end
end


#
# Services are enabled or runnning?
#
services = %w{
  nginx
  mysql
  hhvm
  varnish
}

services.each do |service|
  describe service(service) do
    it { should be_enabled }
    it { should be_running }
  end
end


#
# Web apps are working?
#
apps = {
    'http://hgv.dev/' => /<title>WP Engine Mercury Vagrant<\/title>/,
    'http://hhvm.hgv.dev/' => /<title>WP Engine hhvm Site | Just another WordPress site<\/title>/,
    'http://php.hgv.dev/' => /<title>WP Engine php Site | Just another WordPress site<\/title>/,
    'http://admin.hgv.dev/' => /<title>Admin - WP Engine Mercury Vagrant<\/title>/,
    'http://admin.hgv.dev/phpmyadmin/' => /<title>phpMyAdmin<\/title>/,
    'http://admin.hgv.dev/phpmemcachedadmin' => /<title>phpMemcachedAdmin.*?<\/title>/,
    'http://admin.hgv.dev/logs' => /<title>Pimp my Log<\/title>/,
}

apps.each do |url, content|
  describe command("wget -q #{Shellwords.shellescape(url)} -O - | grep '<title>'") do
    its(:stdout) { should match content }
  end
end


#
# WordPress plugins
#
wp_paths = %w{
  /hgv_data/sites/hhvm
  /hgv_data/sites/php
}

wp_plugins = %w{
  akismet
  debug-bar
  debug-objects
  debug-queries
  hello
  query-monitor
  user-switching
  rewrite-rules-inspector
  log-deprecated-notices
}

wp_paths.each do |path|
  wp_plugins.each do |plugin|
    describe command("wp --path=#{Shellwords.shellescape(path)} plugin status #{Shellwords.shellescape(plugin)}") do
      let(:disable_sudo) { true }
      its(:exit_status) { should eq 0 }
    end
  end
end
