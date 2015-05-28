#!/bin/bash
echo "Provisioning custom sites."
vagrant up
vagrant ssh -c '/bin/bash /vagrant/bin/custom-sites.sh'
