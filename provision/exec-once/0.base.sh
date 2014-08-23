#!/bin/sh

echo "Install basic packages"

wget -O - http://packages.elasticsearch.org/GPG-KEY-elasticsearch | apt-key add -
echo 'deb http://packages.elasticsearch.org/elasticsearch/1.0/debian stable main' > /etc/apt/sources.list.d/elasticsearch.list

apt-get update > /dev/null 2>&1
apt-get install -y vim mc htop \
    curl git mercurial \
    redis-server openjdk-7-jre elasticsearch \
    php5-xdebug php5-curl php-pear > /dev/null 2>&1

/etc/init.d/elasticsearch start