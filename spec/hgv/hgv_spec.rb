require 'hgv_helper'
require 'shellwords'

#
# Hosts are resolvable? or reachable?
#
hosts = %w{
  hhvm.hgv.test
  php.hgv.test
  cache.hhvm.hgv.test
  cache.php.hgv.test
  admin.hgv.test
  xhprof.hgv.test
  mail.hgv.test
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
# mysql service running
# Because of service mysql status permissions denied on pid lock file and
# 'status' doesn't return with 'running' string in the output,
# do it this way
#
describe command('sudo service mysql status') do
  its(:stdout) { should match /Uptime:/ }
end

describe process("mysqld") do
  it { should be_running }
end

#
# Web apps are working?
#
apps = {
    'http://hgv.test/' => /<title>WP Engine Mercury Vagrant<\/title>/,
    'http://hhvm.hgv.test/' => /<title>WP Engine hhvm Site | Just another WordPress site<\/title>/,
    'http://php.hgv.test/' => /<title>WP Engine php Site | Just another WordPress site<\/title>/,
    'http://admin.hgv.test/' => /<title>Admin - WP Engine Mercury Vagrant<\/title>/,
    'http://admin.hgv.test/phpmyadmin/' => /<title>phpMyAdmin<\/title>/,
    'http://admin.hgv.test/phpmemcachedadmin' => /<title>phpMemcachedAdmin.*?<\/title>/,
    'http://admin.hgv.test/logs' => /<title>Pimp my Log<\/title>/,
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
