#!/bin/bash

cp -r /vagrant/provision/dot/.[a-zA-Z0-9]* /home/vagrant/
chown -R vagrant /home/vagrant/.[a-zA-Z0-9]*

cp -r /vagrant/provision/dot/.[a-zA-Z0-9]* /root/
chown -R root /home/vagrant/.[a-zA-Z0-9]*
