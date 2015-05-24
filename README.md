yii2-log
=======

[![Build Status](https://travis-ci.org/index0h/yii2-log.png?branch=master)](https://travis-ci.org/index0h/yii2-log) [![Latest Stable Version](https://poser.pugx.org/index0h/yii2-log/v/stable.png)](https://packagist.org/packages/index0h/yii2-log) [![Dependency Status](https://gemnasium.com/index0h/yii2-log.png)](https://gemnasium.com/index0h/yii2-log) [![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/index0h/yii2-log/badges/quality-score.png?s=305ee4c827a791ab27895799d2c3f3ce9553ea51)](https://scrutinizer-ci.com/g/index0h/yii2-log/) [![Code Coverage](https://scrutinizer-ci.com/g/index0h/yii2-log/badges/coverage.png?s=25e175d218529b7ffa0a2f39cb9204e5b4816843)](https://scrutinizer-ci.com/g/index0h/yii2-log/) [![Total Downloads](https://poser.pugx.org/index0h/yii2-log/downloads.png)](https://packagist.org/packages/index0h/yii2-log) [![License](https://poser.pugx.org/index0h/yii2-log/license.png)](https://packagist.org/packages/index0h/yii2-log)

Different Yii2 log transports

## Now available

* ElasticsearchTarget
* LogstashFileTarget
* LogstashTarget
* RedisTarget

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

```sh
php composer.phar require --prefer-dist index0h/yii2-log "0.0.3"
```

or add line to require section of `composer.json`

```json
"index0h/yii2-log": "0.0.3"
```

## Usage

### Common properties

* `$emergencyLogFile`, default `@app/logs/logService.log`

Elasticsearch, Redis and Logstash - are external services, so if they down our logs must be stored in file.
For that **ElasticsearchTarget**, **LogstashTarget**, **RedisTarget** have option `$emergencyLogFile`. It's alias to
file where logs will be written on log service is down.

### ElasticsearchTarget

Stores logs in elasticsearch. All logs transform to json, so you can simply watch them by [kibana](http://www.elasticsearch.org/overview/kibana/).

Extends yii\log\Target, more options see [here](https://github.com/yiisoft/yii2/blob/master/framework/log/Target.php)

##### Example configuration

```php
....
'components' => [
    'log' => [
        'targets' => [
            ['class' => 'index0h\\log\\ElasticsearchTarget'],
        ....
```

##### Properties

* `index`, default 'yii' - Elasticsearch index name.
* `type`, default 'log' - Elasticsearch index type.
* `componentName` - Name of yii redis component.

### LogstashFileTarget

Extends yii\log\FileTarget, more options see [here](https://github.com/yiisoft/yii2/blob/master/framework/log/FileTarget.php)

##### Example Yii configuration

```php
....
'components' => [
    'log' => [
        'targets' => [
            ['class' => 'index0h\\log\\LogstashFileTarget'],
        ....
```

##### Example Logstash configuration [(current version 1.3.3)](http://logstash.net/docs/1.3.3/)

```
input {
  file {
    type => "yii_log"
    path => [ "path/to/yii/logs/*.log*" ]
    start_position => "end"
    stat_interval => 1
    discover_interval => 30
    codec => "json"
  }
}

filter {
  # ...
}

output {
  stdout => {}
}
```

### LogstashTarget

Extends yii\log\Target, more options see [here](https://github.com/yiisoft/yii2/blob/master/framework/log/Target.php)

##### Example Yii configuration

```php
....
'components' => [
    'log' => [
        'targets' => [
            ['class' => 'index0h\\log\\LogstashTarget'],
            // Or UDP.
            [
                'class' => 'index0h\\log\\LogstashTarget',
                'dsn' => 'udp://localhost:3333'
            ],
            // Or unix socket file.
            [
                'class' => 'index0h\\log\\LogstashTarget',
                'dsn' => 'unix:///path/to/logstash.sock'
            ],
        ....
```

##### Example Logstash configuration [(current version 1.3.3)](http://logstash.net/docs/1.3.3/)

```
input {
  tcp {
    type => "yii_log"
    port => 3333
    codec => "json"
  }
  # Or UDP.
  udp {
    type => "yii_log"
    port => 3333
    codec => "json"
  }
  # Or unix socket file.
  unix {
    type => "yii_log"
    path => "path/to/logstash.sock"
    codec => "json"
  }
}

filter {
  # ...
}

output {
  stdout => {}
}
```


##### Properties

* `dsn`, default `tcp://localhost:3333` - URL to logstash service. Allowed schemas:
    **tcp**, **udp**, **unix** - for unix sock files.

### RedisTarget

Extends yii\log\Target, more options see [here](https://github.com/yiisoft/yii2/blob/master/framework/log/Target.php)

##### Example Yii configuration

```php
....
'components' => [
    'log' => [
        'targets' => [
            ['class' => 'index0h\\log\\RedisTarget'],
        ....
```

##### Example Logstash configuration [(current version 1.3.3)](http://logstash.net/docs/1.3.3/)

```
input {
  redis {
    type => "yii_log"
    key => "yii_log"
    codec => "json"
  }
}

filter {
  # ...
}

output {
  stdout => {}
}
```

##### Properties

* `key`, default `yii_log` - Redis list key.
* `componentName` - Name of yii redis component.

## Testing

#### Run tests from IDE (example for PhpStorm)

- Select Run/Debug Configuration -> Edit Configurations
- Select Add New Configuration -> PHP Script
- Type:
    * File: /path/to/yii-phar/.test.php
    * Arguments run: run  --coverage --html
- OK

#### Run tests from console

```sh
make test
```

-- --

#### Thanks to

[@achretien](https://github.com/achretien)
[@Archy812](https://github.com/Archy812)
[@xt99](https://github.com/xt99)