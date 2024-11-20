#!/usr/bin/env bash

#
# Cleanup
#
docker compose down
docker container prune -f
rm -Rf vendor
rm -f composer.lock

#
# Build
#
docker compose run --rm web composer update

#
# Git
#
git add .
