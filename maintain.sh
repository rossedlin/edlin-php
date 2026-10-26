#!/usr/bin/env bash

#
# Cleanup Docker Environment
#
docker compose down --volumes --remove-orphans

#
# Cleanup Project Files
#
rm -Rf vendor

#
# Build
#
docker compose run --rm web composer update
