shared_examples 'hosts::apps' do

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

end
