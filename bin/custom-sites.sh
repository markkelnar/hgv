#!/bin/bash
#
# This script is invoked by the vagrant provisioner and runs inside the vagrant instance.
# It provisions the default WordPress install and those based on the YML configuration files found in hgv_data/config/sites/.
#
# This script can be run at command line:
# $ vagrant ssh
# $ sudo /bin/bash /vagrant/bin/custom-sites.sh
#
ANS_BIN=`which ansible-playbook`

if [[ -z $ANS_BIN ]]
    then
    echo "Whoops, can't find Ansible anywhere. Aborting run."
    echo
    exit
fi

# More continuous scroll of the ansible standard output buffer
export PYTHONUNBUFFERED=1
export ANSIBLE_FORCE_COLOR=true

if [[ -d /vagrant ]]
then
    HOME_DIR=/vagrant
else
    HOME_DIR=$PWD
fi

# If user specified ansible extra variables file is provided, pass that in to the provisioning
EXTRA=
if [ -e "$HOME_DIR/hgv_data/config/provisioning/ansible.yml" ] ; then
    EXTRA="@$HOME_DIR/hgv_data/config/provisioning/ansible.yml"
fi

shopt -s nullglob
for file in $HOME_DIR/provisioning/default-install.yml $HOME_DIR/hgv_data/config/*.yml $HOME_DIR/hgv_data/config/sites/*.yml
do
    echo "### Provisioning $file ###"
    $ANS_BIN $HOME_DIR/provisioning/wordpress.yml -i'127.0.0.1,' --extra-vars "@$file" --extra-vars "$EXTRA"
done

echo
