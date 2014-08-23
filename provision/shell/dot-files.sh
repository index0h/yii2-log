#!/bin/bash

cp -r /vagrant/provision/dot/.[a-zA-Z0-9]* /home/vagrant/
chown -R vagrant:vagrant /home/vagrant/

cp -r /vagrant/provision/dot/.[a-zA-Z0-9]* /root/
chown -R root:root /root/
