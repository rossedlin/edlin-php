#!/usr/bin/env bash

#
# Cleanup
#
rm -Rf vendor

#
# Build
#
docker compose run --rm web composer update
