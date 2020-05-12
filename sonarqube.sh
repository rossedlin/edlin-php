#!/usr/bin/env bash

#
# You need to run PHPUnit inside the same docker container due to permissions
#
docker run -v $PWD:/var/www rossedlin/centos-apache-php:7.1-dev bash -c \
    "rm -R .report/; vendor/bin/phpunit; /opt/sonar/bin/sonar-scanner;"