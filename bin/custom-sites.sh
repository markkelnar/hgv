#!/bin/bash
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

shopt -s nullglob
for file in /vagrant/provisioning/default-install.yml /vagrant/hgv_data/config/*.yml
do
    echo "### Provisioning $file ###"
    $ANS_BIN /vagrant/provisioning/wordpress.yml -i'127.0.0.1,' --extra-vars="@$file"
done

echo
