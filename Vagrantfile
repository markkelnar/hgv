# -*- mode: ruby -*-
# vi: set ft=ruby :

# Vagrantfile API/syntax version. Don't touch unless you know what you're doing!
VAGRANTFILE_API_VERSION = "2"

dir = Dir.pwd
vagrant_dir = File.expand_path(File.dirname(__FILE__))
vagrant_name = File.basename(dir)

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
        config.hostsupdater.aliases = [
            "hhvm.hgv.dev",
            "php.hgv.dev",
            "fpm.hgv.dev",
            "cache.hhvm.hgv.dev",
            "cache.php.hgv.dev",
            "cache.fpm.hgv.dev",
            "admin.hgv.dev",
            "xhprof.hgv.dev",
            "mail.hgv.dev"
        ]
    end

    # This allows the git commands to work using host server keys
    config.ssh.forward_agent = true

    # To avoid stdin/tty issues
    config.vm.provision "fix-no-tty", type: "shell" do |s|
        s.privileged = false
        s.inline = "sudo sed -i '/tty/!s/mesg n/tty -s \\&\\& mesg n/' /root/.profile"
    end

    config.vm.provision "shell" do |s|
        s.path = "bin/hgv-init.sh"
        s.keep_color = true
    end
end
