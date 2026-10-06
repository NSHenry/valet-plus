<p align="center"><img width="200" src="images/logo.png"></p>

<!-- [![Latest Version on Packagist](https://img.shields.io/packagist/v/weprovide/valet-plus.svg?style=flat)](https://packagist.org/packages/weprovide/valet-plus) -->
<!-- [![Downloads on Packagist](https://img.shields.io/packagist/dt/weprovide/valet-plus.svg?style=flat)](https://packagist.org/packages/weprovide/valet-plus) -->

## Introduction

Valet+ is a development environment for macOS. No Vagrant, no Docker, no `/etc/hosts` file. This project uses 
[laravel/valet](https://github.com/laravel/valet) as a dependency.


## Installation

> :warning: Valet+ requires macOS and [Homebrew](https://brew.sh/). Before installation, you should make sure that no 
> other programs such as Apache or Nginx are binding to your local machine's port 80.

> :warning: Valet+ requires [Composer](https://getcomposer.org/) to be installed. 

To get started, you first need to ensure that Homebrew is up-to-date using the update command:
```shell
brew update
```

Next, you should use Homebrew to install PHP 8.1 (using `shivammathur/php`):
```shell
brew tap shivammathur/php
brew install shivammathur/php/php@8.1
brew link php@8.1 --force
brew services restart php@8.1
```

Make sure your sure the `$HOME/.composer/vendor/bin` directory is in your system's "PATH".

Install Valet+ 3.x with composer:
```shell
composer global require nshenry/valet-plus
```

Finally, you may execute the Valet+ `install` command. This will install and configure Valet+, Nginx, DnsMasq and other
services. In addition, use `--help` to see all installation options. 
```shell
valet-plus install
```

The daemons Valet+ depends on will be configured to launch when your system starts. Once Valet+ is installed, try pinging
any `*.test` domain on your terminal using a command such as `ping foobar.test`. If Valet+ is installed correctly you 
should see this domain responding on `127.0.0.1`.



## Valet+ features

Here are a few key differences compared to the original Valet:

- Nginx config optimization
- PHP extensions (~~mcrypt~~, ~~intl~~, ~~opcache~~, yaml, apcu, ds, imagick)
- MySQL (mysql@5.7, mysql@8.0, mysql@8.1, mariadb)
  - DB commands (list, create, drop, reset, (re)import, export, ~~open~~)
- Mailpit (on/off mode)
- Varnish (on/off mode)
- Redis (on/off mode)
- Rabbitmq (on/off mode)
- Xdebug (on/off mode)
- Memcache (on/off mode)
- Elasticsearch v6, v7, v8 (on/off mode) using Docker 
- Opensearch v2 (on/off mode) using Docker
- ~~Ioncube~~
- Rewrite/unrewrite public domain to local environment
- ~~DevTools~~
- Binaries (magerun, magerun2, drush, wp-cli, shopware-cli)

### Changes vs Valet+ 2

- Use command `valet-plus` instead of `valet`.
- Rename `.env.valet` to `.valet-env.php`.
- Use command `valet-plus elasticsearch|es use <version>` instead of `valet-plus use elasticsearch|es <version>`.
- Use `127.0.0.1` as Redis host instead of `/tmp/redis.sock`.
- Choose which binaries to install (default all) and self-update on `valet-plus install` command.
- Adds dependency on Docker for Elasticsearch, see https://docs.docker.com/desktop/install/mac-install/



