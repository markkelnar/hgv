#!/bin/bash
#
# This is a helper script around the regular WordPress provisioner that sets up the default WordPress install
# and those based on the YML configuration files found in hgv_data/config/sites/.
#
# This script can be run at command line:
# $ bin/mac-linux-custom-sites.sh
#
echo "Provisioning custom sites."
vagrant up
vagrant ssh -c 'sudo /bin/bash /vagrant/bin/custom-sites.sh'
