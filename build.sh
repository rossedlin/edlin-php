#!/usr/bin/env bash

sudo rm -R vendor
docker run -v $PWD:/var/www -vedlin_php_composer:/root/.composer rossedlin/centos-apache-php:7.1 composer update
