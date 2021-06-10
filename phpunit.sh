#!/usr/bin/env bash

docker run -v $PWD:/var/www rossedlin/php-apache:7.1-dev vendor/bin/phpunit
