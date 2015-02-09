#!/bin/bash
echo "

 -------------------------  -----------------
|   _    _                ||  __      __     |
|  | |  | |               ||  \ \    / /     |
|  | |__| |  __           ||   \ \  / /      |
|  |  __  |/ _\` \         ||    \ \/ /       |
|  | |  | | (_| |         ||     \  /        |
|  |_|  |_|\__, |         ||      \/         |
|           __/ |___  __  ||        ___ ____ |
|          |___/( _ )/  \ ||       |_  )__ / |
|               / _ \ () |||        / / |_ \ |
|               \___/\__/ ||       /___|___/ |
 -------------------------  -----------------

"

LSB=`lsb_release -r | awk {'print $2'}`

echo
echo "Updating APT sources."
echo
apt-get update > /dev/null
echo
echo "Installing for Ansible."
echo
apt-get -y install software-properties-common
add-apt-repository -y ppa:ansible/ansible
apt-get update
apt-get -y install ansible
ansible_version=`dpkg -s ansible 2>&1 | grep Version | cut -f2 -d' '`
echo
echo "Ansible installed ($ansible_version)"

ANS_BIN=`which ansible-playbook`

if [[ -z $ANS_BIN ]]
    then
    echo "Whoops, can't find Ansible anywhere. Aborting run."
    echo
    exit
fi

echo
echo "Validating Ansible hostfile permissions."
echo
chmod 644 /vagrant/provisioning/hosts

# More continuous scroll of the ansible standard output buffer
export PYTHONUNBUFFERED=1

# $ANS_BIN /vagrant/provisioning/playbook.yml -i /vagrant/provisioning/hosts
$ANS_BIN /vagrant/provisioning/playbook.yml -i'127.0.0.1,'

echo
