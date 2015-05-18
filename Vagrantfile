# -*- mode: ruby -*-
# vi: set ft=ruby :

# Vagrantfile API/syntax version. Don't touch unless you know what you're doing!
VAGRANTFILE_API_VERSION = "2"

dir = Dir.pwd
vagrant_dir = File.expand_path(File.dirname(__FILE__))
vagrant_name = File.basename(dir)

require 'yaml'

domains_array = ['admin.hgv.dev', 'xhprof.hgv.dev', 'mail.hgv.dev']

def domains_from_yml(file)
    ret = []
    domains = YAML.load_file(file)
    domains['wp']['hhvm_domains'].each do |domain|
        ret.push(domain)
        ret.push('cache.' << domain)
    end
    # php_domains are optional in the user specified file
    unless domains['wp']['php_domains'].nil?
        domains['wp']['php_domains'].each do |domain|
            ret.push(domain)
            ret.push('cache.' << domain)
        end
    end
    return ret
end

# Load default domains 
domains_array += domains_from_yml './conf.d/default-sites.yml'
# Load user specified domain file
Dir.glob("./conf.d/custom-sites*.yml").each do |custom_file|
    domains_array += domains_from_yml custom_file
end

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
    config.vm.box = "ubuntu/trusty64"
    config.vm.hostname = "hgv.dev"
    config.vm.network "private_network", ip: "192.168.150.20"
    config.vm.network "forwarded_port", guest: 3306, host: 23306
    config.vm.network "forwarded_port", guest: 9001, host: 29001
    # Give vm a name
    config.vm.define vagrant_name do |v|
    end

    config.vm.provider "virtualbox" do |vb|
        vb.customize ["modifyvm", :id, "--memory", "1024"]
        vb.customize ["modifyvm", :id, "--natdnshostresolver1", "on"]
        vb.customize ["modifyvm", :id, "--natdnsproxy1", "on"]
        vb.name = vagrant_name
    end

    config.vm.synced_folder "./hgv_data", "/hgv_data", owner: "www-data", group: "www-data", create: "true"

    if defined? VagrantPlugins::HostsUpdater
        config.hostsupdater.aliases = domains_array
    end

    # This allows the git commands to work using host server keys
    config.ssh.forward_agent = true

    # To avoid stdin/tty issues
    config.ssh.shell = "bash -c 'BASH_ENV=/etc/profile exec bash'"

    config.vm.provision "shell" do |s|
        s.path = "bin/hgv-init.sh"
        s.keep_color = true
    end
end
