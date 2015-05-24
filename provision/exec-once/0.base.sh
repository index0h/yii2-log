#!/bin/sh

echo "Install basic packages"

wget -qO - https://packages.elastic.co/GPG-KEY-elasticsearch | sudo apt-key add -
echo 'deb http://packages.elastic.co/elasticsearch/1.5/debian stable main' > /etc/apt/sources.list.d/elasticsearch.list

apt-get update > /dev/null 2>&1
apt-get install -y vim mc htop \
    curl git mercurial \
    redis-server openjdk-7-jre elasticsearch \
    php5-xdebug php5-curl php-pear > /dev/null 2>&1

/etc/init.d/elasticsearch start