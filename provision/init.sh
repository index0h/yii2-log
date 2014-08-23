#!/bin/bash

echo "Init"

export DEBIAN_FRONTEND=noninteractive

if [[ ! -d '/.provision-stuff' ]]; then
    mkdir '/.provision-stuff'
    echo 'Created directory /.provision-stuff'
fi

bash /vagrant/provision/shell/dot-files.sh
bash /vagrant/provision/shell/execute-files.sh
