#!/bin/bash

curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer

su - vagrant -c 'cd /home/vagrant/work; composer install'